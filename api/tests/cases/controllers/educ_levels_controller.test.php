<?php
/* EducLevels Test cases generated on: 2016-01-26 06:52:52 : 1453791172*/
App::import('Controller', 'EducLevels');

class TestEducLevelsController extends EducLevelsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EducLevelsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.educ_level', 'app.student', 'app.year_level', 'app.family');

	function startTest() {
		$this->EducLevels =& new TestEducLevelsController();
		$this->EducLevels->constructClasses();
	}

	function endTest() {
		unset($this->EducLevels);
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
