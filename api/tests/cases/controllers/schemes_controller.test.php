<?php
/* Schemes Test cases generated on: 2020-06-11 11:29:06 : 1591846146*/
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
