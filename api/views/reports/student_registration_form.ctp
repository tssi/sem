<?php
App::import('Vendor','student_registration_form');


$pr= new StudentRegistrationForm();
//pr($data);exit;
if(!empty($data['Student'])){
	$pr->hdr($data['Student']);
}else{
	$pr->newstudent($data['Inquiry']);
}
$pr->data($data);
$pr->output();
?>

