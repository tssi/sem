<?php
/* Assessments Test cases generated on: 2016-02-23 02:01:49 : 1456192909*/
App::import('Controller', 'Assessments');

class TestAssessmentsController extends AssessmentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AssessmentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.assessment', 'app.student', 'app.educ_level', 'app.year_level', 'app.address', 'app.contact_number', 'app.family', 'app.section', 'app.tuition', 'app.program', 'app.fee_breakdown', 'app.fee', 'app.payment_scheme', 'app.scheme', 'app.payment_scheme_schedule', 'app.billing_period', 'app.discount', 'app.tuition_discount', 'app.assessment_adjustment', 'app.assessment_fee', 'app.assessment_schedule');

	function startTest() {
		$this->Assessments =& new TestAssessmentsController();
		$this->Assessments->constructClasses();
	}

	function endTest() {
		unset($this->Assessments);
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
