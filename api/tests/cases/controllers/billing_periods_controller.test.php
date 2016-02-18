<?php
/* BillingPeriods Test cases generated on: 2016-02-05 08:11:30 : 1454659890*/
App::import('Controller', 'BillingPeriods');

class TestBillingPeriodsController extends BillingPeriodsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class BillingPeriodsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.billing_period');

	function startTest() {
		$this->BillingPeriods =& new TestBillingPeriodsController();
		$this->BillingPeriods->constructClasses();
	}

	function endTest() {
		unset($this->BillingPeriods);
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
