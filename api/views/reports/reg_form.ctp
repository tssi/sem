<?php
App::import('Vendor','enroll_registration_form');
pr($DATA_BANK); exit();

$pr= new EnrollRegistrationForm();
//pr($DATA_BANK); exit();
/* if(isset($DATA_BANK[0]['isSecondSem'])){
	//pr($DATA_BANK[0]); exit();	
	$pr->hdr($DATA_BANK[0]['Student'],$DATA_BANK[0]['Assessment'],$DATA_BANK[0]);
	$DATA_BANK[0]['copyOf'] = 'Registrar';
	$pr->data($DATA_BANK[0]);
	$DATA_BANK[0]['copyOf'] = 'Student';
	$pr->data($DATA_BANK[0]);
}else{ */
foreach($DATA_BANK as $i=>$data):
	
	if(!empty($data['Student']))
		$pr->hdr($data['Student'],$data['Assessment'],$data);
	else
		$pr->newstudent($data['Inquiry'],$data['Assessment'],$data['Section']);

	$data['copyOf'] = 'Registrar';
	$pr->data($data);

	$data['Student']['offsetY'] = 7;
	$data['offsetY'] = 7.6;
	if(!empty($data['Student']))
		$pr->hdr($data['Student'],$data['Assessment'],$data);
	else
		$pr->newstudent($data['Inquiry'],$data['Assessment'],$data['Section']);

	$data['copyOf'] = 'Student';
	$pr->data($data);
	if($i<count($DATA_BANK)-1)
		$pr->createSheet();
endforeach;
//}
$pr->output();
?>
