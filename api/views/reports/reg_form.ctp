<?php
App::import('Vendor','enroll_registration_form');


$pr= new EnrollRegistrationForm();
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

$pr->output();
?>

