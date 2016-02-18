<?php
/* TuitionDiscounts Test cases generated on: 2016-02-11 02:29:26 : 1455157766*/
App::import('Controller', 'TuitionDiscounts');

class TestTuitionDiscountsController extends TuitionDiscountsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TuitionDiscountsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.tuition_discount', 'app.tuition', 'app.year_level', 'app.educ_level', 'app.student', 'app.address', 'app.contact_number', 'app.family', 'app.fee_breakdown', 'app.fee', 'app.payment_scheme', 'app.scheme', 'app.payment_scheme_schedule', 'app.discount');

	function startTest() {
		$this->TuitionDiscounts =& new TestTuitionDiscountsController();
		$this->TuitionDiscounts->constructClasses();
	}

	function endTest() {
		unset($this->TuitionDiscounts);
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
