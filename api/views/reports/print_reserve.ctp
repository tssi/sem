<?php
App::import('Vendor','reserved_students');

	$pr = new ReservedStudent();
	$chunk_data = array_chunk($data['breakdown'],45,true);
	$total_page = count($chunk_data);
	$i = 1;
	//pr($chunk_data); exit();
	$pr->hdr($data['summary'],$data['totals'],$data);
	$pr->createSheet();
	foreach($chunk_data as $dt){
		$pr->data($dt,$i);
		if(count($chunk_data)!=($i++)){
			$pr->createSheet();
		}
	}
	$pr->output();
?>

