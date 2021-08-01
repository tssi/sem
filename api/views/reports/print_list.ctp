<?php
App::import('Vendor','enrollment_stats');

	$ESS = new EnrollmentStatSheet();
	
	foreach($data as $d){
		$chunk_data = array_chunk($d['lists'],50,true);
		foreach($chunk_data as $breakdown){
			$ESS->enrollment_list($d['level'],$breakdown);
			$ESS->createSheet();
		}
		
		//exit();
	}
	//$ESS->today_stat($data['today']);
	//pr($data); exit();
	
	$ESS->output();

?>