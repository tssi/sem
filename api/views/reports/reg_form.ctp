<?php
App::import('Vendor','enroll_registration_form');


$pr= new EnrollRegistrationForm();

if(!empty($data['Student']))
	$pr->hdr($data['Student'],$data['Assessment'],$data);
else
	$pr->newstudent($data['Inquiry'],$data['Assessment'],$data['Section']);

$data['copyOf'] = 'Registrar';
$pr->data($data);

$data['Student']['offsetY'] = 6.5;
$data['offsetY'] = 7.1;
if(!empty($data['Student']))
	$pr->hdr($data['Student'],$data['Assessment'],$data);
else
	$pr->newstudent($data['Inquiry'],$data['Assessment'],$data['Section']);

$data['copyOf'] = 'Student';
$pr->data($data);

$pr->output();
?>

