<?php 
include('header.php');		
include('f137_controller.php');	
$F137->db_connect();
$EGB->db_connect();	
$sno='2004-04328';
$get_sec = $EGB->get_nrol_section($sno);
$get_stud=$EGB->get_stud201($sno);
$get_attendance=$EGB->report_card_attendance(2011, $sno, $get_sec);
//attendance
$total = 0;
$total_present = 0;
//days of school & days present

$days = array();
foreach($get_attendance as $att){
	$total = $total+$att['days'];
	$total_present = $total_present+$att['present'];
	$record = array('days'=>$att['days']);
	array_push($days,$record);
}
$present = array();
foreach($get_attendance as $att){
	$record = array('present'=>$att['present']);
	array_push($present,$record);
}

$std_info= array(
			'name'=>$get_stud['fname'],
			'dob'=>$get_stud['bday'],
			'pob'=>$get_stud['pob'],
			'gender'=>$get_stud['gender'],
			'add'=>$get_stud['h_sn']." ".$get_stud['h_m'],
			'par'=>$get_stud['g_n'],
			'occ'=>$get_stud['g_o'],
);

$table_one = array (
			'hdr'=>array(
				'clas'=>'classified as',
				'school'=>'FAITH',
				'sy'=>'2011-2012',
				'fr'=>'99.99',
				'action'=>'passed',
				'remarks'=>'remarks'
			),
			'att'=> array(
				'days'=>$days,
				'present'=>$present,
				'total'=>$total,
				'total_present'=>$total_present
			)			
);

$per_ratings = array (
			'hdr'=>array(
				'clas'=>'classified as',
				'school'=>'FAITH',
				'sy'=>'2011-2012'
			),
			'cont'=>array(
				'subject'=>array(
					array(
						'subject'=>'Reading',
						'p1'=>99.32,
						'p2'=>99.32,
						'p3'=>99.32,
						'p4'=>99.32,
						'fg'=>99.99
					),
					array(
						'subject'=>'Language',
						'p1'=>99.32,
						'p2'=>99.32,
						'p3'=>99.32,
						'p4'=>99.32,
						'fg'=>99.99
					),
					array(
						'subject'=>'Mathematics',
						'p1'=>99.32,
						'p2'=>99.32,
						'p3'=>99.32,
						'p4'=>99.32,
						'fg'=>99.99
					),
					array(
						'subject'=>'Science',
						'p1'=>99.32,
						'p2'=>99.32,
						'p3'=>99.32,
						'p4'=>99.32,
						'fg'=>99.99
					),
					array(
						'subject'=>'Filipino',
						'p1'=>99.32,
						'p2'=>99.32,
						'p3'=>99.32,
						'p4'=>99.32,
						'fg'=>99.99
					)
				)
			),
			'att'=> array(
				'days'=>$days,
				'present'=>$present,
				'total'=>$total,
				'total_present'=>$total_present
			)			
);
/* echo "<pre>";
print_r($per_ratings);
echo "</pre>"; */
?>