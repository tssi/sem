<?php
/* PaymentDueDates Test cases generated on: 2020-06-11 11:36:18 : 1591846578*/
App::import('Controller', 'PaymentDueDates');

class TestPaymentDueDatesController extends PaymentDueDatesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PaymentDueDatesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.payment_due_date', 'app.scheme');

	function startTest() {
		$this->PaymentDueDates =& new TestPaymentDueDatesController();
		$this->PaymentDueDates->constructClasses();
	}

	function endTest() {
		unset($this->PaymentDueDates);
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
