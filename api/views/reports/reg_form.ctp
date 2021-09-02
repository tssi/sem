<?php
App::import('Vendor','enroll_registration_form');


$pr= new EnrollRegistrationForm();
//pr($data);exit;
if(!empty($data['Student'])){
	$pr->hdr($data['Student'],$data['Assessment'],$data);
}else{
	//pr($data); exit();
	$pr->newstudent($data['Inquiry'],$data['Assessment'],$data['Section']);
}
$pr->data($data);
$pr->output();
?>

