<?php
App::import('Vendor','student_pre_assess_form');


$pr= new StudentPreAssessForm();
if(!empty($data['Student'])){
	$pr->hdr($data['Student'],$data['Assessment'],$data);
}else{
	$pr->newstudent($data['Inquiry'],$data['Assessment'],$data['Section']);
}
$pr->data($data);
$pr->output();
?>

