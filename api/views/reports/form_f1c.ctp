<?php
App::import('Vendor','admission_inq_f1c');
$f1c = new AdmissionInquiryForm1C();
$f1c->hdr();
$f1c->info();
$f1c->output();