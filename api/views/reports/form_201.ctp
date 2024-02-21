<?php
App::import('Vendor','admission_inq_201');
$f201 = new AdmissionInquiryForm201();
$f201->hdr();
$f201->info($student,false);
$f201->footNotes();
$f201->output($fileName,'I');
return;