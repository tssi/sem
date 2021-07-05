<?php
App::import('Vendor','enrollment_stats');

	$ESS = new EnrollmentStatSheet();

	$ESS->today_stat($data['today']);
	$ESS->overall_stat($data['overall'],$data['totals']);
	$ESS->output();

?>