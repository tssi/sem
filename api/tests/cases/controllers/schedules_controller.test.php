<?php
/* Schedules Test cases generated on: 2020-05-29 12:16:53 : 1590725813*/
App::import('Controller', 'Schedules');

class TestSchedulesController extends SchedulesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SchedulesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.schedule', 'app.section', 'app.department', 'app.program', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.year_level', 'app.student', 'app.schedule_detail', 'app.room');

	function startTest() {
		$this->Schedules =& new TestSchedulesController();
		$this->Schedules->constructClasses();
	}

	function endTest() {
		unset($this->Schedules);
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
