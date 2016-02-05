<?php
/* Schemes Test cases generated on: 2016-02-05 01:00:55 : 1454634055*/
App::import('Controller', 'Schemes');

class TestSchemesController extends SchemesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SchemesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.scheme');

	function startTest() {
		$this->Schemes =& new TestSchemesController();
		$this->Schemes->constructClasses();
	}

	function endTest() {
		unset($this->Schemes);
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
