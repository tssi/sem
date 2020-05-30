<?php
/* Curriculums Test cases generated on: 2020-05-30 12:21:04 : 1590812464*/
App::import('Controller', 'Curriculums');

class TestCurriculumsController extends CurriculumsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CurriculumsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.curriculum', 'app.department', 'app.program', 'app.section', 'app.year_level', 'app.student', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.curriculum_section', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.curriculum_detail', 'app.subject');

	function startTest() {
		$this->Curriculums =& new TestCurriculumsController();
		$this->Curriculums->constructClasses();
	}

	function endTest() {
		unset($this->Curriculums);
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
