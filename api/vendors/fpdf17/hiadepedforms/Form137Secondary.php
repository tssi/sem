<?php
//STSN Form 137-A Back Page
include('Form137_Secondary.php');  
include('data_137.php');

$form= new STSNForm();
/* echo "<pre>";
print_r($DATA_BANK);  */
for($a=0;$a<count($DATA_BANK);$a++){
	if($a){
		$form->createSheet();
	}
	$level = $DATA_BANK[$a]['level'];
	$stopover = $DATA_BANK[$a]['stopover'];
	$std_info = $DATA_BANK[$a]['std_info'];
	$grade_pane = $DATA_BANK[$a]['grade_pane'];
	$form-> hdr();
	$x=0;
	$form-> personalinfo($std_info);
	for($i=1;$i<=count($YEAR_LVL);$i++){ 
		if($i == 2){
		$x = 4.6;
		}else if($i == 3){
		$form->createSheet();
		$x = -2;
		}
		else if($i == 4){
		$x = 2.6;
		}
		if($i<=$level){
			$form-> tableOne($x,'II',$grade_pane[$i]);
		}else{
			$form-> tableOne($x,'I',NULL);
		}
	}
	$form-> ftr();
}
$form->output();

?>