<?php
/* Rooms Test cases generated on: 2020-05-29 12:16:31 : 1590725791*/
App::import('Controller', 'Rooms');

class TestRoomsController extends RoomsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class RoomsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.room', 'app.schedule_detail', 'app.schedule', 'app.section', 'app.department', 'app.program', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.year_level', 'app.student');

	function startTest() {
		$this->Rooms =& new TestRoomsController();
		$this->Rooms->constructClasses();
	}

	function endTest() {
		unset($this->Rooms);
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
