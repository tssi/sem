<?php
/* Tuitions Test cases generated on: 2020-06-09 14:49:18 : 1591685358*/
App::import('Controller', 'Tuitions');

class TestTuitionsController extends TuitionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TuitionsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.tuition', 'app.year_level', 'app.department', 'app.program', 'app.section', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.student', 'app.curriculum', 'app.curriculum_detail', 'app.subject', 'app.curriculum_section', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.fee_breakdown', 'app.fee');

	function startTest() {
		$this->Tuitions =& new TestTuitionsController();
		$this->Tuitions->constructClasses();
	}

	function endTest() {
		unset($this->Tuitions);
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
