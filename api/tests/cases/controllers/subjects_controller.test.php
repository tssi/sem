<?php
/* Subjects Test cases generated on: 2020-06-08 15:56:49 : 1591603009*/
App::import('Controller', 'Subjects');

class TestSubjectsController extends SubjectsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SubjectsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.subject', 'app.department', 'app.program', 'app.section', 'app.year_level', 'app.student', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.curriculum', 'app.curriculum_detail', 'app.curriculum_section', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module');

	function startTest() {
		$this->Subjects =& new TestSubjectsController();
		$this->Subjects->constructClasses();
	}

	function endTest() {
		unset($this->Subjects);
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
