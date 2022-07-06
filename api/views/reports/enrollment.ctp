<?php
App::import('Vendor','enrollment_stats');

	$ESS = new EnrollmentStatSheet();

	$ESS->today_stat($data['today']);
	$chunk_data = array_chunk($data['overall'],24);
	$i=1;
	$cnt = 1;
	//pr($chunk_data); exit();
	foreach($chunk_data as $dt){
		
		foreach($dt as $ctr=>$d){
			$dt[$ctr]['cnt']=$cnt;
			$cnt++;
		}
		if($i!=count($chunk_data))
			$ESS->overall_stat($dt,$i);
		else 
			$ESS->overall_stat($dt,$data['totals']);
		if(count($chunk_data)!=($i++)){
			$ESS->createSheet();
		}
	}
	$ESS->output();

?>