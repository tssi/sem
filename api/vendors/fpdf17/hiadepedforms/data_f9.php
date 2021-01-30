<?php 
include('header.php');		
include('f137_controller.php');	
include('../curriculum.php');
$CURRI->db_connect();
$F137->db_connect();
$EGB->db_connect();	
$YEAR_LVL = array('1','2','3','4');
$sno = $_POST['prnt_sno'];
$sy = $_POST['prnt_sy'];
$school ='Holly Trinity Academy';
$mode = $_POST['prnt_mode'];
$classcode=$_POST['prnt_classcode'];
$code = explode("-",$classcode);
$get_stud_nrol = $EGB ->get_stud_nrol('',$code[0], $sy);
$students = array();
$DATA_BANK = array();
$ALL_SUBJECTS = array();
if($mode != 'individual'){
	$students = $get_stud_nrol;
}else{
	$students[0]['sno'] = $sno; 
}
for($x=0;$x<count($students);$x++){
	$sno = $students[$x]['sno'];
	$get_stud=$EGB->get_stud201($sno);
	$get_sec = $EGB->get_nrol_section($sno);
	$attendance=$F137->get_gsup_attnd($sno);
	$get_lvl=$EGB->get_sec_alias($EGB->get_nrol_section($sno));
	$deptcode = $get_lvl[0]['dept'];
	$gryrlvl = $get_lvl[0]['level'];
	$section = $get_lvl[0]['section'];
	$stopover=0; 
	for($i=0;$i<count($YEAR_LVL);$i++)
	{
		if($YEAR_LVL[$i]==$gryrlvl){
			$stopover=$i;
			break;
		}
	}
	if($stopover>0){
		$get_gsup_dtl=$F137->get_gsup_dtl($sno);
		$get_hdr=$F137->get_gsup_hdg($sno);
		$get_subjects=$F137->get_subjects($deptcode, $gryrlvl, $sy);
		$grade_pane = array();	
		for($b=0;$b<$stopover;$b++){
			$level = $YEAR_LVL[$b];
			$earned = 0;
			$tunit = 0;
			$subject = array();
			$clas='';
			if(isset($get_gsup_dtl[$level])){
				foreach($get_gsup_dtl[$level] as $gsub){
					if($level == "1"){
						$clas = "FIRST YEAR";
					}
					else if ($level == "2"){
						$clas = "SECOND YEAR";
					}
					else if ($level == "3"){
						$clas = "THIRD YEAR";
					}
					$unit = $gsub['unit'];
					$nomen=$gsub['nomen'];
					$fi=$gsub['final'];
					$tunit += $unit;
					if($fi>=75||$fi=='O'||$fi=='VG'||$fi=='G'||$fi=='S'||$fi=='NG'){
						$unit = $gsub['unit'];
					}else{
						if($fi<75 ||$fi=='F'){
							$unit = 0;
						}
					}
					$index = str_replace(' ','',$nomen).$sno;
					if(!isset($ALL_SUBJECTS[$index])){
						$ALL_SUBJECTS[$index]=array('nomen'=>$nomen, 'unit'=>$unit, 'code'=>$index);
					}
					if($fi>=75||$fi=='O'||$fi=='VG'||$fi=='G'||$fi=='S'||$fi=='NG'){
						$action = "passed";
						$earned = $earned+$gsub['unit'];
						$ALL_SUBJECTS[$index]['unit']+= $gsub['unit'];
					}else{
						if($fi<75 ||$fi=='F'){
							$action = "failed";
						}
					}
					$record = array(
									'subject'=>$gsub['nomen'],
									'earned'=>$unit==0?'-':number_format($unit,2,'.',''),
									'fr'=>$gsub['first'],
									'se'=>$gsub['second'],
									'th'=>$gsub['third'],
									'fo'=>$gsub['fourth'],
									'cs_ave'=>$gsub['final'],
									'action'=>$action
								);
					array_push($subject,$record);
				}
			}
			$hdr= array();
			if(isset($get_hdr[$level])){
				$hdr= array(
							'clas'=>$clas,
							'school'=>$get_hdr[$level]['school'],
							'sy'=>$get_hdr[$level]['sy']
						);
			}
			$dtl= $subject;
			$foot=array();
			if(isset($attendance[$level])){
				$foot= array(
							'tdos'=>$attendance[$level]['total_s'],
							'tdp'=>$attendance[$level]['total_p'],
							'tunits'=>number_format($tunit,2,'.',''),
							'earned'=>number_format($earned,2,'.',''),
							'total_ys'=>'X'
						);	
			}					
			$grade_pane[$level]['hdr'] = $hdr;
			$grade_pane[$level]['dtl'] = $dtl;
			$grade_pane[$level]['foot'] = $foot;		
		}
	}
	//CURRENT YEAR
	$attendance=$EGB->report_card_attendance($sy, $sno, $get_sec);
	//$get_subjects=$EGB->report_card_grades($sy, $sno, $get_sec); 
	$get_subjects = $CURRI->get_report_grades($sy, $get_sec, $sno);
	$hdr=$F137->get_gsup_hdg($sno);
	$grades = array();
	$subjects = array();
	$total = isset($attendance[10]['school_days'])?$attendance[10]['school_days']:'';
	$present = isset($attendance[10]['present'])?$attendance[10]['present']:'';	
	$tunit = 0;
	$earned = 0;
	foreach($get_subjects[$sno]['subjects'] as $subj)	{
		$unit = $subj['unit'];
		$nomen=$subj['nomen'];
		$index = str_replace(' ','',$nomen).$sno;
		
		if(!isset($ALL_SUBJECTS[$index])){
			$ALL_SUBJECTS[$index]=array('nomen'=>$nomen, 'unit'=>'','code'=>$index);
		}
		$fi = $subj['final']['lgrade'];
		if($fi>=75||$fi=='O'||$fi=='VG'||$fi=='G'||$fi=='S'||$fi=='NG'){
				$action = "passed";
				$earned = $earned+$subj['unit'];
				$ALL_SUBJECTS[$index]['unit']+= $subj['unit'];
				$tunit +=$unit;
		}else{
			if($fi<75 ||$fi=='F'){
				$action = "failed";
			}
		}
		$record = array(
					'subject'=>$subj['nomen'],
					'cs_ave'=>$subj['final']['lgrade'],
					'fr'=>$subj['p1']['lgrade'],
					'se'=>$subj['p2']['lgrade'],
					'th'=>$subj['p3']['lgrade'],
					'fo'=>$subj['p4']['lgrade'],
					'earned'=>number_format($subj['unit'],2,'.',''),
					'action'=>$action
				);
		array_push($subjects,$record);
	}
	$std_info = array(
					'name'=>$get_stud['fname'].' '.$get_stud['mname'].' '.$get_stud['lname'],
					'dob'=>$get_stud['bday'],
					'pob'=>$get_stud['pob'],
					'gaur'=>$get_stud['p_n'],
					'elem'=>'x',
					'sy'=>$sy,
					'gen'=>'XX',
					'add'=>'X',
					'lvlcomp'=>'X',
					'total_yelem'=>'X',
					'sno'=>$sno
				);
	if($YEAR_LVL[$stopover] == "1"){
		$clas = "FIRST YEAR";
	}
	else if ($YEAR_LVL[$stopover] == "2"){
		$clas = "SECOND YEAR";
	}
	else if ($YEAR_LVL[$stopover] == "3"){
		$clas = "THIRD YEAR";
	}else if ($YEAR_LVL[$stopover] == "4"){
		$clas = "FOURTH YEAR";
	}
	$grades = array(
					'hdr'=> array(
								'clas'=>$clas,
								'school'=>$school,
								'sy'=>$sy
							),
					'dtl'=> $subjects,
					'foot'=> array(
									'tdos'=>$total,
									'tdp'=>$present,
									'tunits'=>number_format($tunit,2,'.',''),
									'earned'=>number_format($earned,2,'.',''),
									'total_ys'=>'X'
								),
				);
	$s = array(
				'hdr' => Array(
								'clas' => 'SECOND YEAR',
								'school' => 'asdasdasd',
								'sy' => 2232
							),
				'dtl' => Array(
								 Array(
										'subject' => 'MATHEMATICS',
										'earned' => 1.00,
										'fr' => 0,
										'se' => 0,
										'th' => 0,
										'fo' => 0,
										'cs_ave' => 99,
										'action' => 'passed'
									),
								 Array(
										'subject' => 'SCIENCE',
										'earned' => 3.00,
										'fr' => 0,
										'se' => 0,
										'th' => 0,
										'fo' => 0,
										'cs_ave' => 99,
										'action' => 'passed'
								),
								Array(
										'subject' => 'CONDUCT',
										'earned' => 1.20,
										'fr' => 0,
										'se' => 0,
										'th' => 0,
										'fo' => 0,
										'cs_ave' => 99,
										'action' => 'passed'
									)
							),
				'foot' => Array(
								'tdos' => 'X',
								'tdp' => 'X',
								'tunits' => 'X',
								'earned' => 'X',
								'total_ys' => 'X',
								'eval_by'=>'X'
							)
			);
	$level = $YEAR_LVL[$stopover];
	$grade_pane[$level] = $grades;
	$grade_pane['s'] = $s;
	$student_data = array(
						'std_info'=>$std_info,
						'grades'=>$grade_pane,
						'level'=>$level,
						'stopover'=>$stopover
					);
	array_push($DATA_BANK,$student_data);
}
?>