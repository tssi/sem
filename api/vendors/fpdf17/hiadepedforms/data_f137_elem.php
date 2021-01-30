<?php
include('f137_controller.php');	
include('../curriculum.php');
include('../header.php');			
include('../promote.php');	
include('../inflector.php');		
$YEAR_LVL = array('N','K','P','1','2','3','4','5','6');
$CURRI->db_connect();
$F137->db_connect();		
$EGB->db_connect();	
$PROMOTE->db_connect();	
$sno =$_POST['prnt_sno'];
$SY =$_POST['prnt_sy'];
$SCHOOL = 'Holly Trinity Academy';
$mode =  $_POST['prnt_mode'];
$classcode=$_POST['prnt_classcode'];
$code =  explode("-",$classcode);
$get_stud_nrol = $EGB ->get_stud_nrol('', $code[0], $SY);
$students = array();
$DATA_BANK = array();
$gryrlv_promote = array(
					  'PS'=>array('Nursery','Kinder','Prep'),
					  'GS'=>array('Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6'),
					  'HS'=>array('Grade 7', 'Second Year', 'Third Year','Fourth Year'),
					  'TS'=>array('First Year College'),
					);
/* echo "<pre>";
print_r($get_stud_nrol);
exit(); */
if($mode != 'individual'){
	$students = $get_stud_nrol;
}else{
	$students[0]['sno'] = $sno; 
}
for($x=0;$x<count($students);$x++){
	$preptog3 =array();
	$g4tog6 = array();
	$sno = $students[$x]['sno'];	
	$get_stud=$EGB->get_stud201($sno);
	$get_sec = $EGB->get_nrol_section($sno);
	$get_lvl=$EGB->get_sec_alias($get_sec);
	$yr_lvl=$get_lvl[0]['level'];
	$dept=$get_lvl[0]['dept'];
	$std_info= array(
					'name'=>$get_stud['fname'].' '.$get_stud['mname'].' '.$get_stud['lname'],
					'dob'=>$get_stud['bday'],
					'pob'=>$get_stud['pob'],
					'gender'=>$get_stud['gender'],
					'add'=>$get_stud['h_sn']." ".$get_stud['h_m'],
					'tel'=>$get_stud['land'],
					'par'=>$get_stud['p_n'],
					'occ'=>$get_stud['p_o']
				);
	
	$get_psgs3=$F137->get_psgs3($sno);
	foreach($get_psgs3 as $row=>$col){
		$recard = array(
					'sy'=>$col['sy'],
					'enter'=>$col['date_enter'],
					'left'=>$col['date_exit'],
					'school'=>$col['school'],
					'grade'=>$col['yrlvl'],
					'present'=>$col['att'],
					'rating'=>$col['final_rate'],
					'prom'=>$col['prom_ret'],
					'adviser'=>$col['adviser'],		
					'adviser'=>$col['adviser'],	
					'days'=>100
				);
		array_push($preptog3,$recard);
	}
	$stopover=0;
	if($dept == 'PS'){
		switch($yr_lvl){
			case 1:
				$yr_lvl = 'N';
				break;
			case 2:
				$yr_lvl = 'K';
				break;
			case 3:
				$yr_lvl = 'P';
				break;
		}
	}
	for($i=0;$i<count($YEAR_LVL);$i++)
	{
		if($YEAR_LVL[$i]==$yr_lvl){
			$stopover=$i;
			break;
		}
	}
	if($stopover <3){
		$get_subjects=$EGB->report_card_grades($SY, $sno, $get_sec);
		$get_adviser=$EGB->get_adviser($get_sec, $SY);
		$adviser=$EGB->get_users($get_adviser['fid']);
		$attendance =$EGB->report_card_attendance($SY, $sno, $get_sec);
		$days_present = $attendance[0]['present']+$attendance[1]['present']+$attendance[2]['present']+$attendance[3]['present']+$attendance[4]['present']+$attendance[5]['present']+$attendance[6]['present']+$attendance[7]['present']+$attendance[8]['present']+$attendance[9]['present'];
		array_push($preptog3,array(
					'sy'=>$SY,
					'enter'=>'',
					'left'=>'',
					'school'=>$SCHOOL,
					'grade'=>$YEAR_LVL[$stopover],
					'present'=>$days_present,
					'rating'=>'',
					'prom'=>'',
					'adviser'=>Inflector::intials($adviser['first_name']." ".$adviser['middle_name']." ").$adviser['last_name']
		));
	}
	else{
		if($stopover>3){
			$subjects=$F137->get_subjects($dept,$yr_lvl,$SY);	
			$details=$F137->get_gsup_dtl($sno);	
			$att=$F137->get_gsup_attnd($sno);
			$header=$F137->get_gsup_hdg($sno);	
			//print_r($header);
			for($b=3;$b<$stopover;$b++){
				$level = $YEAR_LVL[$b];
				$attendance = isset($att[$level])?$att[$level]:'';			
				$hh=isset($header[$level])?$header[$level]:'';
				$hdr=array();
				if(isset($header[$level])){
					$hdr =array(
							'grade'=>$hh['yrlvl'],
							'section'=>$hh['seccode'],
							'school'=>$hh['school'],
							'adviser'=>$hh['adviser'],
							'sy'=>$hh['sy'],
							'pro'=>$hh['promoted'],		
							'ret'=>$hh['retained'],		
							'gen'=>$hh['gen_ave'],
							'total_y' => 'X',
							'clas' => $gryrlv_promote['GS'][$level-1],
							'school' => $hh['school'],
							'sy' => $hh['sy']
						);
				}
				$dtl=array();
				if(isset($details[$level])){
					foreach($details[$level] as $comp_code=>$col){
						$record = array('subject'=>'','period'=>array(),'final'=>'');
						$record['period']=array($col['first'],$col['second'],$col['third'],$col['fourth']);
						$record['final']=$col['final'];
						$record['subject']=$col['nomen'];
						array_push($dtl,$record);
					}
				}
				$att_arr= array(
							'ds'=>array(
									'june'=>isset($attendance['jun_s'])?$attendance['jun_s']:'',
									'july'=>isset($attendance['jul_s'])?$attendance['jul_s']:'',
									'aug'=>isset($attendance['aug_s'])?$attendance['aug_s']:'',
									'sep'=>isset($attendance['sep_s'])?$attendance['sep_s']:'',
									'oct'=>isset($attendance['oct_s'])?$attendance['oct_s']:'',
									'nov'=>isset($attendance['nov_s'])?$attendance['nov_s']:'',
									'dec'=>isset($attendance['dec_s'])?$attendance['dec_s']:'',
									'jan'=>isset($attendance['jan_s'])?$attendance['jan_s']:'',
									'feb'=>isset($attendance['feb_s'])?$attendance['feb_s']:'',
									'mar'=>isset($attendance['mar_s'])?$attendance['mar_s']:'',
									'apr'=>isset($attendance['apr_s'])?$attendance['apr_s']:'',
									'total'=>isset($attendance['total_s'])?$attendance['total_s']:''

								),
							'dp'=>array(
									'june'=>isset($attendance['jun'])?$attendance['jun']:'',
									'july'=>isset($attendance['jul'])?$attendance['jul']:'',
									'aug'=>isset($attendance['aug'])?$attendance['aug']:'',
									'sep'=>isset($attendance['sep'])?$attendance['sep']:'',
									'oct'=>isset($attendance['oct'])?$attendance['oct']:'',
									'nov'=>isset($attendance['nov'])?$attendance['nov']:'',
									'dec'=>isset($attendance['dec'])?$attendance['dec']:'',
									'jan'=>isset($attendance['jan'])?$attendance['jan']:'',
									'feb'=>isset($attendance['feb'])?$attendance['feb']:'',
									'mar'=>isset($attendance['mar'])?$attendance['mar']:'',
									'apr'=>isset($attendance['apr'])?$attendance['apr']:'',
									'total'=>isset($attendance['total_p'])?$attendance['total_p']:''
								)
					);
				$g4tog6[$level]['dtl']=$dtl;
				$g4tog6[$level]['att']=$att_arr;
				$g4tog6[$level]['hdr']=$hdr;
			}	
		}
		
		//curr
		//$get_subjects=$EGB->report_card_grades($SY, $sno, $get_sec); //original 
		$get_subjects = $CURRI->get_report_grades($SY, $get_sec, $sno); // for testing
		$get_adviser=$EGB->get_adviser($get_sec, $SY);
		$adviser=$EGB->get_users($get_adviser['fid']);
		$attendance =$EGB->report_card_attendance($SY, $sno, $get_sec);
		$promote =$PROMOTE->details($sno,$SY);
		$dtl=array();
		/* echo "<pre>";
		print_r($attendance);
		exit();   */
		/*  if(count($attendance)<2){
			continue;
		}  */
		//$level = $gryrlv_promote[$promote['dept']][$promote['level']-1];
		$hdr =array(
				'grade'=>$get_lvl[0]['level'],
				'section'=>$get_lvl[0]['section'],
				'school'=>$SCHOOL,
				'adviser'=>strtoupper($adviser['first_name']." ".$adviser['middle_name']." ".$adviser['last_name']),
				'sy'=>$SY.' - '.($SY+1),
				'pro'=>'',//$promote['is_promoted']?$level:'',		
				'ret'=>'',//!$promote['is_promoted']?$level:'',		
				'gen'=>'',//$promote['gen_ave'],
				'total_y' => 'X',
				'clas' => $gryrlv_promote['GS'][$get_lvl[0]['level']-1],
				'school' => $SCHOOL
			);	
			if(!isset($get_subjects[$sno]['subjects'])){
				continue;
			}
		foreach($get_subjects[$sno]['subjects'] as $col){
			$record = array(
							'subject'=>$col['nomen'],
							'period'=> array(
								$col['p1'],
								$col['p2'],
								$col['p3'],
								$col['p4']
							),
							'final'=>$col['final']
						);
			array_push($dtl,$record);
		}
		$total = 0;
		$present = 0;
		$att_arr= array(
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
							'total'=>isset($attendance[$sno][10]['present'])?$attendance[$sno][10]['present']:''
						) 
				);
		$level = $YEAR_LVL[$stopover];
		$g4tog6[$level]['dtl']=$dtl;
		$g4tog6[$level]['att']=$att_arr;
		$g4tog6[$level]['hdr']=$hdr; 
	}
	
	$student_data = array(
						'std_info'=>$std_info,
						'preptog3'=>$preptog3,
						'g4tog6'=>$g4tog6,
						'level'=>$yr_lvl,
						'stopover'=>$stopover
					);
	array_push($DATA_BANK,$student_data);
	/* echo "<pre>";
	print_r($DATA_BANK); */
}
?>