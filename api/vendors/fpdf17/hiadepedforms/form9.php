<?php
//STSN Form 9
include('Form_9.php'); 
include('data_f9.php'); 
$form= new STSNForm();
for($a=0;$a<count($DATA_BANK);$a++){
	if($a){
		$form->createSheet();
	}
	$level = $DATA_BANK[$a]['level'];
	$stopover = $DATA_BANK[$a]['stopover'];
	$std_info = $DATA_BANK[$a]['std_info'];
	$grades = $DATA_BANK[$a]['grades'];
	$form-> hdr();
	$form-> personalinfo($std_info);
	for($i=0;$i<count($YEAR_LVL);$i++){
		$level = $YEAR_LVL[$i];
		if($level == 1){
			$class = 'FIRST YEAR';
			$x=0;
			$y=0;
		}else if($level == 2){
			$class = 'SECOND YEAR';
			$x=3.95;
			$y=0;
		}else if($level == 3){
			$class = 'THIRD YEAR';
			$x=0;
			$y=2.98;
		}else if($level == 4){
			$class = 'FOURTH YEAR';
			$x=3.95;
			$y=2.98;
		}
		if($i<=$stopover)
			$form-> tableOne($x,$y,$class,$grades[$level]);
		else
			$form-> tableOne($x,$y,$class,NULL);
	}
	$form-> tableTwo(0,5.96,'SUMMER',$grades['s']);
	$form-> tableThree($ALL_SUBJECTS,$std_info);
	$form-> ftr();
}
$form->output();
?>