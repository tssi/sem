<?php
App::import('Vendor','student_registration_form');
//pr($data);exit;

$pr= new StudentRegistrationForm();
$pr->hdr($data['Student']);
$pr->data($data);

$pr->output();
?>

