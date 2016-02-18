<?php
/* PaymentSchemes Test cases generated on: 2016-02-18 08:57:54 : 1455785874*/
App::import('Controller', 'PaymentSchemes');

class TestPaymentSchemesController extends PaymentSchemesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PaymentSchemesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.payment_scheme', 'app.tuition', 'app.year_level', 'app.educ_level', 'app.student', 'app.address', 'app.contact_number', 'app.family', 'app.program', 'app.fee_breakdown', 'app.fee', 'app.discount', 'app.tuition_discount', 'app.scheme', 'app.payment_scheme_schedule', 'app.billing_period');

	function startTest() {
		$this->PaymentSchemes =& new TestPaymentSchemesController();
		$this->PaymentSchemes->constructClasses();
	}

	function endTest() {
		unset($this->PaymentSchemes);
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
