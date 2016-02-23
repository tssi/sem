<?php
/* AssessmentSchedules Test cases generated on: 2016-02-23 02:02:13 : 1456192933*/
App::import('Controller', 'AssessmentSchedules');

class TestAssessmentSchedulesController extends AssessmentSchedulesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AssessmentSchedulesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.assessment_schedule', 'app.assessment', 'app.student', 'app.educ_level', 'app.year_level', 'app.address', 'app.contact_number', 'app.family', 'app.section', 'app.tuition', 'app.program', 'app.fee_breakdown', 'app.fee', 'app.payment_scheme', 'app.scheme', 'app.payment_scheme_schedule', 'app.billing_period', 'app.discount', 'app.tuition_discount', 'app.assessment_adjustment', 'app.assessment_fee');

	function startTest() {
		$this->AssessmentSchedules =& new TestAssessmentSchedulesController();
		$this->AssessmentSchedules->constructClasses();
	}

	function endTest() {
		unset($this->AssessmentSchedules);
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
