<?php
/* Citizenships Test cases generated on: 2016-01-27 07:04:46 : 1453878286*/
App::import('Controller', 'Citizenships');

class TestCitizenshipsController extends CitizenshipsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CitizenshipsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.citizenship');

	function startTest() {
		$this->Citizenships =& new TestCitizenshipsController();
		$this->Citizenships->constructClasses();
	}

	function endTest() {
		unset($this->Citizenships);
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
