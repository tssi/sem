<?php
/* AssessmentSchedule Test cases generated on: 2016-02-23 02:00:35 : 1456192835*/
App::import('Model', 'AssessmentSchedule');

class AssessmentScheduleTestCase extends CakeTestCase {
	var $fixtures = array('app.assessment_schedule', 'app.assessment', 'app.student', 'app.educ_level', 'app.year_level', 'app.address', 'app.contact_number', 'app.family', 'app.section', 'app.tuition', 'app.program', 'app.fee_breakdown', 'app.fee', 'app.payment_scheme', 'app.scheme', 'app.payment_scheme_schedule', 'app.billing_period', 'app.discount', 'app.tuition_discount', 'app.assessment_adjustment', 'app.assessment_fee');

	function startTest() {
		$this->AssessmentSchedule =& ClassRegistry::init('AssessmentSchedule');
	}

	function endTest() {
		unset($this->AssessmentSchedule);
		ClassRegistry::flush();
	}

}
