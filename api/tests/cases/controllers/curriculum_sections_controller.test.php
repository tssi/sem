<?php
/* CurriculumSections Test cases generated on: 2020-05-30 12:20:42 : 1590812442*/
App::import('Controller', 'CurriculumSections');

class TestCurriculumSectionsController extends CurriculumSectionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CurriculumSectionsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.curriculum_section', 'app.section', 'app.department', 'app.program', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.year_level', 'app.student', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.curriculum', 'app.curriculum_detail', 'app.subject');

	function startTest() {
		$this->CurriculumSections =& new TestCurriculumSectionsController();
		$this->CurriculumSections->constructClasses();
	}

	function endTest() {
		unset($this->CurriculumSections);
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
