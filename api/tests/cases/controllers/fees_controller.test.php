<?php
/* Fees Test cases generated on: 2020-06-09 14:49:48 : 1591685388*/
App::import('Controller', 'Fees');

class TestFeesController extends FeesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FeesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.fee', 'app.fee_breakdown', 'app.tuition', 'app.year_level', 'app.department', 'app.program', 'app.section', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.student', 'app.curriculum', 'app.curriculum_detail', 'app.subject', 'app.curriculum_section', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module');

	function startTest() {
		$this->Fees =& new TestFeesController();
		$this->Fees->constructClasses();
	}

	function endTest() {
		unset($this->Fees);
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
