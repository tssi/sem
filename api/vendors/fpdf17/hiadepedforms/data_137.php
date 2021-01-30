<?php 
include('f137_controller.php');	
include('../curriculum.php');
include('../header.php');
include('../inflector.php');
$YEAR_LVL = array('1','2','3','4');
$F137->db_connect();
$EGB->db_connect();	
$CURRI->db_connect();
$F137->db_connect();	
$SCHOOL = 'Holly Trinity Academy';
$sy =$_POST['prnt_sy'];
$sno =$_POST['prnt_sno'];
$mode =  $_POST['prnt_mode'];
$classcode=$_POST['prnt_classcode'];
$code =  explode("-",$classcode);
$get_stud_nrol = $EGB ->get_stud_nrol('', $code[0], $sy);
$students = array();
$DATA_BANK = array();
if($mode != 'individual'){
	$students = $get_stud_nrol;
}else{
	$students[0]['sno'] = $sno; 
}
for($x=0;$x<count($students);$x++){
	$sno = $students[$x]['sno'];
	$get_stud=$EGB->get_stud201($sno);
	$header=$F137->get_gsup_hdg($sno);
	$get_lvl=$EGB->get_sec_alias($EGB->get_nrol_section($sno));
	$yr_lvl=$get_lvl[0]['level'];
	$get_sec = $EGB->get_nrol_section($sno);
	$stopover=0;
	for($k=0;$k<count($YEAR_LVL);$k++)
	{
		if($YEAR_LVL[$k]==$yr_lvl){
			$stopover=$k;
			break;
		}
	}
	if($yr_lvl == 1){
	$levely = 'Grade 7';
	}else if($yr_lvl == 2){
	$levely = 'SECOND YEAR';
	}else if($yr_lvl == 3){
	$levely = 'THIRD YEAR';
	}else if($yr_lvl == 4){
	$levely = 'FOURTH YEAR';
	}
	//student information
	$std_info= array(
				'name'=>$get_stud['fname'].' '.Inflector::intials($get_stud['mname']).' '.$get_stud['lname'],
				'dob'=>$get_stud['bday'],
				'pob'=>$get_stud['pob'],
				'gender'=>$get_stud['gender'],
				'add'=>$get_stud['h_sn']." ".$get_stud['h_m'],
				'tel'=>$get_stud['land'],
				'par'=>$get_stud['p_n'],
				'occ'=>$get_stud['p_o'],
	);
	if($stopover>0){
		$get_gsup_dtl=$F137->get_gsup_dtl($sno);
		$att=$F137->get_gsup_attnd($sno);
		/*  echo "<pre>";
		print_r($get_gsup_dtl); */
		 /* if(count($get_gsup_dtl)==0){
			continue;
		}  */
		$grade_pane = array();
		for($b=0;$b<$stopover;$b++){
			$level = $YEAR_LVL[$b];
			if(isset($header[$level])){
				$hh=$header[$level];
			}
			if(isset($att[$level])){
			$attendance = $att[$level];	
			}
			//content
			$subject = array();
			$clas = '';
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
					$fi = $gsub['final'];
					if($fi>75||$fi=='O'||$fi=='VG'||$fi=='G'||$fi=='S'||$fi=='NG'||$fi=='F'){
						$action = "Passed";
					}else{
						if($fi<75 || $fi=='NI'){
							$action = "Failed";
						}
					}
					$record = array(
						'subject'=>$gsub['nomen'],
						'earned'=>Inflector::subject_unit($gsub['unit']),
						'fr'=>$gsub['first'],
						'se'=>$gsub['second'],
						'th'=>$gsub['third'],
						'fo'=>$gsub['fourth'],
						'cs_ave'=>$gsub['final'],
						'unit'=>Inflector::subject_unit($gsub['unit']),
						'action'=>$action,	
					);
					array_push($subject,$record);
				}
			}
			//header	
			$hdr = array();
			if(isset($header[$level])){
				$hdr =array(
							'yr_lvl'=>$clas,
							'section'=>$hh['seccode'],
							'school'=>$hh['school'],
							'adviser'=>$hh['adviser'],
							'sy'=>Inflector::school_year($hh['sy'])
						);
			}
			$foot= array();
			if(isset($att[$level])){
				$foot= array(
							'ds'=>array(
									'june'=>$attendance['jun_s'],
									'july'=>$attendance['jul_s'],
									'aug'=>$attendance['aug_s'],
									'sep'=>$attendance['sep_s'],
									'oct'=>$attendance['oct_s'],
									'nov'=>$attendance['nov_s'],
									'dec'=>$attendance['dec_s'],
									'jan'=>$attendance['jan_s'],
									'feb'=>$attendance['feb_s'],
									'mar'=>$attendance['mar_s'],
									'apr'=>$attendance['apr_s'],
									'total'=>$attendance['total_s'],

								),
							'dp'=>array(
									'june'=>$attendance['jun'],
									'july'=>$attendance['jul'],
									'aug'=>$attendance['aug'],
									'sep'=>$attendance['sep'],
									'oct'=>$attendance['oct'],
									'nov'=>$attendance['nov'],
									'dec'=>$attendance['dec'],
									'jan'=>$attendance['jan'],
									'feb'=>$attendance['feb'],
									'mar'=>$attendance['mar'],
									'apr'=>$attendance['apr'],
									'total'=>$attendance['total_p'],
								)
						);
			}				
			$grade_pane[$level]['hdr']=$hdr;	
			$grade_pane[$level]['dtl']=$subject;
			$grade_pane[$level]['foot']=$foot;
		}	
	}
	//current
	//$attendance=$EGB->report_card_attendance($sy, $sno, $get_sec);//original
	//$get_subjects=$EGB->report_card_grades($sy, $sno, $get_sec); //original
	$get_subjects = $CURRI->get_report_grades($sy, $get_sec, $sno);
	$attendance =$EGB->report_card_attendance($sy, $sno, $get_sec);
	$get_adviser=$EGB->get_adviser($get_sec, $sy);
	$adviser=$EGB->get_users($get_adviser['fid']);
	$hdr=$F137->get_gsup_hdg($sno);
	$hdr =array(
				'yr_lvl'=>$levely,
				'section'=>$get_lvl[0]['section'],
				'school'=>$SCHOOL,
				'adviser'=>Inflector::intials($adviser['first_name']." ".$adviser['middle_name']." ").$adviser['last_name'],
				'sy'=>Inflector::school_year($sy)
			);
	 /* echo "<pre>";
	print_r($get_subjects);
	exit();   */
	//content
	$subject = array();
	foreach($get_subjects[$sno]['subjects'] as $gsub){
		if($gsub['final']['grade']>=75||$gsub['final']['grade']!='C'){
			$action = "Passed";
		}
		else{
			$action = "Failed";
		}
		$record = array(
						'subject'=>$gsub['nomen'],
						'earned'=>Inflector::subject_unit($gsub['unit']),
						'fr'=>$gsub['p1']['lgrade'],
						'se'=>$gsub['p2']['lgrade'],
						'th'=>$gsub['p3']['lgrade'],
						'fo'=>$gsub['p4']['lgrade'],
						'cs_ave'=>$gsub['final']['lgrade'],
						'unit'=>Inflector::subject_unit($gsub['unit']),
						'action'=>$action
					);
		array_push($subject,$record);
	}
	//attendance
	$total = 0;
	$present = 0;
	$foot= array(
				'ds'=>array(
						'june'=>isset($attendance[$sno][0]['school_days'])?$attendance[$sno][0]['school_days']:'',
						'july'=>isset($attendance[$sno][1]['school_days'])?$attendance[$sno][1]['school_days']:'',
						'aug'=>isset($attendance[$sno][2]['school_days'])?$attendance[$sno][2]['school_days']:'',
						'sep'=>isset($attendance[$sno][3]['school_days'])?$attendance[$sno][3]['school_days']:'',
						'oct'=>isset($attendance[$sno][4]['school_days'])?$attendance[$sno][4]['school_days']:'',
						'nov'=>isset($attendance[$sno][5]['school_days'])?$attendance[$sno][5]['school_days']:'',
						'dec'=>isset($attendance[$sno][6]['school_days'])?$attendance[$sno][6]['school_days']:'',
						'jan'=>isset($attendance[$sno][7]['school_days'])?$attendance[$sno][7]['school_days']:'',
						'feb'=>isset($attendance[$sno][8]['school_days'])?$attendance[$sno][8]['school_days']:'',
						'mar'=>isset($attendance[$sno][9]['school_days'])?$attendance[$sno][9]['school_days']:'',
						'apr'=>'-',
						'total'=>isset($attendance[$sno][10]['school_days'])?$attendance[$sno][10]['school_days']:''
					),
				'dp'=>array(
						'june'=>isset($attendance[$sno][0]['present'])?$attendance[$sno][0]['present']:'',
						'july'=>isset($attendance[$sno][1]['present'])?$attendance[$sno][1]['present']:'',
						'aug'=>isset($attendance[$sno][2]['present'])?$attendance[$sno][2]['present']:'',
						'sep'=>isset($attendance[$sno][3]['present'])?$attendance[$sno][3]['present']:'',
						'oct'=>isset($attendance[$sno][4]['present'])?$attendance[$sno][4]['present']:'',
						'nov'=>isset($attendance[$sno][5]['present'])?$attendance[$sno][5]['present']:'',
						'dec'=>isset($attendance[$sno][6]['present'])?$attendance[$sno][6]['present']:'',
						'jan'=>isset($attendance[$sno][7]['present'])?$attendance[$sno][7]['present']:'',
						'feb'=>isset($attendance[$sno][8]['present'])?$attendance[$sno][8]['present']:'',
						'mar'=>isset($attendance[$sno][9]['present'])?$attendance[$sno][9]['present']:'',
						'apr'=>'-',
						'total'=>isset($attendance[$sno][10]['present'])?$attendance[$sno][10]['present']:'',
					)
			);
	$level = $YEAR_LVL[$stopover];			
	$grade_pane[$level]['hdr']=$hdr;	
	$grade_pane[$level]['dtl']=$subject;
	$grade_pane[$level]['foot']=$foot;
	$student_data = array(
						'std_info'=>$std_info,
						'grade_pane'=>$grade_pane,
						'level'=>$level,
						'stopover'=>$stopover
					);
	array_push($DATA_BANK,$student_data);
	/* echo "<pre>";
	print_r($DATA_BANK); */
}

?>