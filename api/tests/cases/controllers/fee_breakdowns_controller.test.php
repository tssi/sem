<?php
/* FeeBreakdowns Test cases generated on: 2020-06-09 14:49:30 : 1591685370*/
App::import('Controller', 'FeeBreakdowns');

class TestFeeBreakdownsController extends FeeBreakdownsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FeeBreakdownsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.fee_breakdown', 'app.tuition', 'app.year_level', 'app.department', 'app.program', 'app.section', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.student', 'app.curriculum', 'app.curriculum_detail', 'app.subject', 'app.curriculum_section', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.fee');

	function startTest() {
		$this->FeeBreakdowns =& new TestFeeBreakdownsController();
		$this->FeeBreakdowns->constructClasses();
	}

	function endTest() {
		unset($this->FeeBreakdowns);
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
