<?php
/* AssessmentAdjustments Test cases generated on: 2016-02-23 02:02:43 : 1456192963*/
App::import('Controller', 'AssessmentAdjustments');

class TestAssessmentAdjustmentsController extends AssessmentAdjustmentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AssessmentAdjustmentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.assessment_adjustment', 'app.assessment', 'app.student', 'app.educ_level', 'app.year_level', 'app.address', 'app.contact_number', 'app.family', 'app.section', 'app.tuition', 'app.program', 'app.fee_breakdown', 'app.fee', 'app.payment_scheme', 'app.scheme', 'app.payment_scheme_schedule', 'app.billing_period', 'app.discount', 'app.tuition_discount', 'app.assessment_fee', 'app.assessment_schedule');

	function startTest() {
		$this->AssessmentAdjustments =& new TestAssessmentAdjustmentsController();
		$this->AssessmentAdjustments->constructClasses();
	}

	function endTest() {
		unset($this->AssessmentAdjustments);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
