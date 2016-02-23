<?php
/* AssessmentAdjustment Test cases generated on: 2016-02-23 02:00:44 : 1456192844*/
App::import('Model', 'AssessmentAdjustment');

class AssessmentAdjustmentTestCase extends CakeTestCase {
	var $fixtures = array('app.assessment_adjustment', 'app.assessment', 'app.student', 'app.educ_level', 'app.year_level', 'app.address', 'app.contact_number', 'app.family', 'app.section', 'app.tuition', 'app.program', 'app.fee_breakdown', 'app.fee', 'app.payment_scheme', 'app.scheme', 'app.payment_scheme_schedule', 'app.billing_period', 'app.discount', 'app.tuition_discount', 'app.assessment_fee', 'app.assessment_schedule');

	function startTest() {
		$this->AssessmentAdjustment =& ClassRegistry::init('AssessmentAdjustment');
	}

	function endTest() {
		unset($this->AssessmentAdjustment);
		ClassRegistry::flush();
	}

}
