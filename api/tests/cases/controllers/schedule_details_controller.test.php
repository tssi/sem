<?php
/* ScheduleDetails Test cases generated on: 2020-05-29 12:16:42 : 1590725802*/
App::import('Controller', 'ScheduleDetails');

class TestScheduleDetailsController extends ScheduleDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ScheduleDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.schedule_detail', 'app.schedule', 'app.section', 'app.department', 'app.program', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.year_level', 'app.student', 'app.room');

	function startTest() {
		$this->ScheduleDetails =& new TestScheduleDetailsController();
		$this->ScheduleDetails->constructClasses();
	}

	function endTest() {
		unset($this->ScheduleDetails);
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
