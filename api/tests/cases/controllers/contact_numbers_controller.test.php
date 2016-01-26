<?php
/* ContactNumbers Test cases generated on: 2016-01-26 06:52:52 : 1453791172*/
App::import('Controller', 'ContactNumbers');

class TestContactNumbersController extends ContactNumbersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ContactNumbersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.contact_number');

	function startTest() {
		$this->ContactNumbers =& new TestContactNumbersController();
		$this->ContactNumbers->constructClasses();
	}

	function endTest() {
		unset($this->ContactNumbers);
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
