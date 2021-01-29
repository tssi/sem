<?php
//STSN Form 137-A Elementary Fornt Page 
include('Form137_elem.php');
include('data_f137_elem.php');
$form= new STSNForm();
/* echo "<pre>";
print_r($DATA_BANK);
exit(); */
for($x=0;$x<count($DATA_BANK);$x++){
	if($x){
		$form->createSheet();
	}
	$level = $DATA_BANK[$x]['level'];
	$stopover = $DATA_BANK[$x]['stopover'];
	$std_info = $DATA_BANK[$x]['std_info'];
	$preptog3 = $DATA_BANK[$x]['preptog3'];
	$g4tog6 = $DATA_BANK[$x]['g4tog6'];

	$form-> hdr();
	$form-> PersonalInfo($std_info);
	$form-> tableOne($preptog3);
	$y = 0;
	
	for($i=3;$i<count($YEAR_LVL);$i++){ 
		if($i==6){
		$form->createSheet();
		$y = -2.8;
		}
		$level = $YEAR_LVL[$i];
		$grades = null;
		if(isset($g4tog6[$level])){
			$grades = $g4tog6[$level];
		}
		$form-> tableTwo($y,$grades);
		/* echo "<pre>";
		print_r($grades); */
		$y =$y+3.20;
	
	}
	$form-> ftr();
}
$form->output();
?>