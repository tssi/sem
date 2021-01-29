<?php 
include('../header.php');			
include('../inflector.php');	
include('../curriculum.php');		
include('../promote.php');			
include('f137_controller.php');	
$PROMOTE->db_connect();		
$F137->db_connect();				
$EGB->db_connect();	
$CURRI->db_connect();	
$division = 'City School';
$school = 'Holly Trinity Academy';
$sy =$_POST['prnt_sy'];
$classcode=$_POST['prnt_classcode'];
$code =  explode("-",$classcode);
$section = $EGB->get_sec_alias($code[0]);
$get_adviser = $EGB->get_adviser($code[0],$sy);
$adviser=$EGB->get_users($get_adviser['fid']);
//$get_subjects=$EGB->get_subjects($section[0]['dept'],$section[0]['level'], $sy,false);
$get_subjects = $CURRI->get_subjects($code[0],$sy);
/* echo "<pre>";
print_r($get_subjects); */

$subjects=array();
foreach($get_subjects as $subj)	{
	if($subj['isprintreportcard']){
	$record = array('name'=>$subj['nomen'],'alias'=>$subj['alias']);
	array_push($subjects,$record);
	}
}
$stud_nrol=$EGB->get_stud_nrol('', $code[0], $sy);	
$final_rate= $EGB->get_final_scores($sy,5,$code);
$final_attendance = $EGB->get_attendance($code[0], $sy, 5);
$attendance=array();
for($i=0;$i<count($final_attendance);$i++){
	$attendance[trim($final_attendance[$i]['sno'])] = $final_attendance[$i];
}
$grades = array();
foreach($final_rate as $k => $v){
	$grades[$v['sno']][$v['comp_code']]=$v;
}
$DISPLAY_ROUND=2;
$students=array();
$total_sd = 0;
for($q=0;$q<=4;$q++){
	foreach($EGB->get_attendance_tmplt($sy,$q) as $get_att){
		$total_sd += $get_att['days'];
	}
}
foreach($stud_nrol as $row=>$col){
	$get_stud=$EGB->get_stud201($col['sno']);
	$add = $get_stud['h_sn'].' '. $get_stud['h_m'];
	$yrs = 'x';
	$gender = $col['gender'];
	$age = Inflector::f18_age($get_stud['bday']);
	/* if(!isset($attendance[trim($col['sno'])])){
		continue;
	} */
	$att = isset($attendance[trim($col['sno'])]['absent'])?$attendance[trim($col['sno'])]['absent']:'';
	/* if(!isset($grades[$col['sno']])){
		continue;
	} */
	$final_grade=isset($grades[$col['sno']])?$grades[$col['sno']]:'';
	$promote =$PROMOTE->details($col['sno'],$sy);
	$grade_arr = array();
	if(count($att)==0){
		continue;
	} 
	foreach($get_subjects as $subj)	{
		if($subj['isprintreportcard']){
			$g =isset($final_grade[$subj['comp_code']])?$final_grade[$subj['comp_code']]:'';
			$record = array(
				'fg'=>isset($g['grade'])?number_format($g['grade'],$DISPLAY_ROUND):'',
				);
			array_push($grade_arr,$record);
		}
	}	
	$gryrlv_promote = array(
					  'PS'=>array('Nursery','Kinder','Prep'),
					  'GS'=>array('Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6'),
					  'HS'=>array('Grade 7', 'Second Year', 'Third Year','Fourth Year'),
					  'TS'=>array('First Year College'),
					);
	$record = array(
					'name'=>$col['fullname'],
					'gender'=>$gender,
					'add'=>$add,
					'yrs'=>$yrs,
					'att'=>($total_sd-$att),
					'age'=>$age,
					'grades'=>$grade_arr,
					'pro'=>$promote['is_promoted'],
					'ret'=>!$promote['is_promoted'],
					'gen'=>number_format($promote['gen_ave'],2,'.','')
			);
		array_push($students,$record);
		
	$total_mprom = 0;
	$total_fprom = 0;
	foreach($students as $stud){
		if($promote['is_promoted']&&$stud['gender']=='M'){
			$total_mprom+=1;
		}else if($promote['is_promoted']&&$stud['gender']=='F'){
			$total_fprom+=1;
		}
	}
}
	
$curri_info = array(
				'sy'=>$sy.'-'.($sy+1),
				'curri'=>'X',
				'school'=>$school,
				'city'=>'Manila',
				'date'=>date('M d, Y',time()),
				'curri_yr'=>'2012-2013',
				'grade'=>$section[0]['level'],
				'section'=>$section[0]['section'],
				'div'=>$division,
				//'total_mprom'=>$total_mprom,
				//'total_fprom'=>$total_fprom,
				'total_mprom'=>'x',
				'total_fprom'=>'x',
				'adv'=>Inflector::intials($adviser['first_name']." ".$adviser['middle_name']." ").$adviser['last_name']
			);
$sp_pane = array(
				'subjects'=> $subjects,
				'student'=>$students
			);	
?>