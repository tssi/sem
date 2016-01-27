<?php
/* Families Test cases generated on: 2016-01-26 06:52:53 : 1453791173*/
App::import('Controller', 'Families');

class TestFamiliesController extends FamiliesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FamiliesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.family', 'app.student', 'app.educ_level', 'app.year_level');

	function startTest() {
		$this->Families =& new TestFamiliesController();
		$this->Families->constructClasses();
	}

	function endTest() {
		unset($this->Families);
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
