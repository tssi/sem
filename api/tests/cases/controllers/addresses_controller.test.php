<?php
/* Addresses Test cases generated on: 2016-01-26 06:52:52 : 1453791172*/
App::import('Controller', 'Addresses');

class TestAddressesController extends AddressesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AddressesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.address');

	function startTest() {
		$this->Addresses =& new TestAddressesController();
		$this->Addresses->constructClasses();
	}

	function endTest() {
		unset($this->Addresses);
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
