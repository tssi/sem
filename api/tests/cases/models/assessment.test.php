<?php
/* Assessment Test cases generated on: 2016-02-23 01:59:23 : 1456192763*/
App::import('Model', 'Assessment');

class AssessmentTestCase extends CakeTestCase {
	var $fixtures = array('app.assessment', 'app.student', 'app.educ_level', 'app.year_level', 'app.address', 'app.contact_number', 'app.family', 'app.section', 'app.tuition', 'app.program', 'app.fee_breakdown', 'app.fee', 'app.payment_scheme', 'app.scheme', 'app.payment_scheme_schedule', 'app.billing_period', 'app.discount', 'app.tuition_discount', 'app.assessment_adjustment', 'app.assessment_fee', 'app.assessment_schedule');

	function startTest() {
		$this->Assessment =& ClassRegistry::init('Assessment');
	}

	function endTest() {
		unset($this->Assessment);
		ClassRegistry::flush();
	}

}
