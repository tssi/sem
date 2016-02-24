<?php
/* PaymentSchemeSchedules Test cases generated on: 2016-02-18 07:36:48 : 1455781008*/
App::import('Controller', 'PaymentSchemeSchedules');

class TestPaymentSchemeSchedulesController extends PaymentSchemeSchedulesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PaymentSchemeSchedulesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.payment_scheme_schedule');

	function startTest() {
		$this->PaymentSchemeSchedules =& new TestPaymentSchemeSchedulesController();
		$this->PaymentSchemeSchedules->constructClasses();
	}

	function endTest() {
		unset($this->PaymentSchemeSchedules);
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
