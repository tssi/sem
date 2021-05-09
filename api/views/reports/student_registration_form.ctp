<?php
App::import('Vendor','student_registration_form');


$pr= new StudentRegistrationForm();
//pr($data);exit;
if(!empty($data['Student'])){
	$pr->hdr($data['Student'],$data['Assessment'],$data);
}else{
	$pr->newstudent($data['Inquiry'],$data['Assessment']);
}
$pr->data($data);
$pr->output();
?>

