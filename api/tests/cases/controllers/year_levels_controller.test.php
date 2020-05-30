<?php
/* YearLevels Test cases generated on: 2020-05-29 10:56:50 : 1590721010*/
App::import('Controller', 'YearLevels');

class TestYearLevelsController extends YearLevelsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class YearLevelsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.year_level', 'app.department', 'app.program', 'app.section', 'app.student', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module');

	function startTest() {
		$this->YearLevels =& new TestYearLevelsController();
		$this->YearLevels->constructClasses();
	}

	function endTest() {
		unset($this->YearLevels);
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
