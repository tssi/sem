<?php
/* YearLevels Test cases generated on: 2016-01-26 06:52:53 : 1453791173*/
App::import('Controller', 'YearLevels');

class TestYearLevelsController extends YearLevelsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class YearLevelsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.year_level', 'app.educ_level', 'app.student', 'app.family');

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
