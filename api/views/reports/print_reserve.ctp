<?php
App::import('Vendor','reserved_students');

	$pr = new ReservedStudent();
	$chunk_data = array_chunk($data['breakdown'],48,true);
	$total_page = count($chunk_data);
	$i = 1;
	pr($chunk_data); exit();

	foreach($chunk_data as $dt){
		$pr->data($dt,$i);
		if(count($chunk_data)!=($i++)){
			$pr->createSheet();
		}
	}
	$pr->output();
?>

