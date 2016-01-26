<?php
/* Provinces Test cases generated on: 2016-01-26 06:52:53 : 1453791173*/
App::import('Controller', 'Provinces');

class TestProvincesController extends ProvincesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProvincesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.province', 'app.country', 'app.city', 'app.barangay');

	function startTest() {
		$this->Provinces =& new TestProvincesController();
		$this->Provinces->constructClasses();
	}

	function endTest() {
		unset($this->Provinces);
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
