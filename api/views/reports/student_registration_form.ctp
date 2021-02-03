<?php
App::import('Vendor','student_registration_form');


$pr= new StudentRegistrationForm();

if(!empty($data['Inquiry'])){
	$pr->newstudent($data['Inquiry']);
}else{
	$pr->hdr($data['Student']);
}

$pr->data($data);
$pr->output();
?>

