<?php
/* CurriculumDetails Test cases generated on: 2020-05-30 12:20:33 : 1590812433*/
App::import('Controller', 'CurriculumDetails');

class TestCurriculumDetailsController extends CurriculumDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CurriculumDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.curriculum_detail', 'app.curriculum', 'app.department', 'app.program', 'app.section', 'app.year_level', 'app.student', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.curriculum_section', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.subject');

	function startTest() {
		$this->CurriculumDetails =& new TestCurriculumDetailsController();
		$this->CurriculumDetails->constructClasses();
	}

	function endTest() {
		unset($this->CurriculumDetails);
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
