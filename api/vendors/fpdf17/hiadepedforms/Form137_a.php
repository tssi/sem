<?php
//STSN Form 137-A
include('Form137a.php');
include('data_f137_ps.php');
$form= new STSNForm();
for($x=0;$x<count($DATA_BANK);$x++){
	if($x){
		$form->createSheet();
	}
	$level = $DATA_BANK[$x]['level'];
	$stopover = $DATA_BANK[$x]['stopover'];
	$std_info = $DATA_BANK[$x]['std_info'];
	$g4tog6 = $DATA_BANK[$x]['g4tog6'];
	$y =0;
	if(isset($g4tog6['N']))
		$form-> tableOne($g4tog6['N']);
	else
		$form-> tableOne(NULL);
	$form-> PersonalInfo($std_info);
	$form-> hdr();
	for($i=1;$i<count($YEAR_LVL);$i++){ 
		if($i==1){
			$a = 'K';
		}else if($i==2){
			$a = 'P';
		}
		if(isset($g4tog6[$a])){
			$form-> tableTwo($y,$g4tog6[$a]);
		}else{
			$form-> tableTwo($y,NULL);
		}
		$y+=3.2;
	}
	$form-> ftr();
}
$form->output();
?>