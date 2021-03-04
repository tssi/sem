<?php
App::import('Vendor',"student_inquiry_information_sheet");

$pr= new InquiryInformationSheet();
$pr->info();
$pr->output();
?>