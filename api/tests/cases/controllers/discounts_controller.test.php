<?php
/* Discounts Test cases generated on: 2016-02-05 01:00:42 : 1454634042*/
App::import('Controller', 'Discounts');

class TestDiscountsController extends DiscountsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DiscountsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.discount');

	function startTest() {
		$this->Discounts =& new TestDiscountsController();
		$this->Discounts->constructClasses();
	}

	function endTest() {
		unset($this->Discounts);
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
