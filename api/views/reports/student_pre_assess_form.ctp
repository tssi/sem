<?php
App::import('Vendor','student_pre_assess_form');


$pr= new StudentPreAssessForm();
if(!isset($data_bank)){
	if(!empty($data['Student'])){

		$pr->hdr($data['Student'],$data['Assessment'],$data,1);
		$pr->hdr($data['Student'],$data['Assessment'],$data,35);
	}
	else{
		$pr->newstudent($data['Inquiry'],$data['Assessment'],$data['Section'],1);
		$pr->newstudent($data['Inquiry'],$data['Assessment'],$data['Section'],35);
	}
	
	$pr->data($data,8.5);
	$pr->data($data,42.5 );
	
}else{
	foreach($data_bank as $i=>$data){
		if(!empty($data['Student'])){
			$pr->hdr($data['Student'],$data['Assessment'],$data,1);
			$pr->hdr($data['Student'],$data['Assessment'],$data,35);
		}
		else{
			$pr->newstudent($data['Inquiry'],$data['Assessment'],$data['Section'],1);
			$pr->newstudent($data['Inquiry'],$data['Assessment'],$data['Section'],35);
		}
			
		
		$pr->data($data,8.5);
		$pr->data($data,42.5 );
		if($i<count($data_bank)-1)
			$pr->createSheet();
	}
}
$pr->output();

?>

