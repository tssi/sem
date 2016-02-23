<?php
/* AssessmentFee Test cases generated on: 2016-02-23 01:59:30 : 1456192770*/
App::import('Model', 'AssessmentFee');

class AssessmentFeeTestCase extends CakeTestCase {
	var $fixtures = array('app.assessment_fee', 'app.assessment', 'app.student', 'app.educ_level', 'app.year_level', 'app.address', 'app.contact_number', 'app.family', 'app.section', 'app.tuition', 'app.program', 'app.fee_breakdown', 'app.fee', 'app.payment_scheme', 'app.scheme', 'app.payment_scheme_schedule', 'app.billing_period', 'app.discount', 'app.tuition_discount', 'app.assessment_adjustment', 'app.assessment_schedule');

	function startTest() {
		$this->AssessmentFee =& ClassRegistry::init('AssessmentFee');
	}

	function endTest() {
		unset($this->AssessmentFee);
		ClassRegistry::flush();
	}

}
