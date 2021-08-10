<?php
App::import('Vendor','enrollment_stats');

	$ESS = new EnrollmentStatSheet();
	//pr($data); exit();
	if(isset($data[0]['level'])){
		foreach($data as $d){
			$chunk_data = array_chunk($d['lists'],50,true);
			foreach($chunk_data as $breakdown){
				$ESS->enrollment_list($d['level'],$breakdown);
				$ESS->createSheet();
			}
		}
	}else{
		foreach($data as $d){
			$chunk_data = array_chunk($d['lists'],50,true);
			foreach($chunk_data as $breakdown){
				$ESS->enrollment_days($d['date'],$breakdown);
				$ESS->createSheet();
			}
		}
	}
	//$ESS->today_stat($data['today']);
	//pr($data); exit();
	
	$ESS->output();

?>