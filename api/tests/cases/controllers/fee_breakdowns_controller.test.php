<?php
/* FeeBreakdowns Test cases generated on: 2016-02-05 01:19:04 : 1454635144*/
App::import('Controller', 'FeeBreakdowns');

class TestFeeBreakdownsController extends FeeBreakdownsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FeeBreakdownsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.fee_breakdown', 'app.tuition', 'app.year_level', 'app.educ_level', 'app.student', 'app.address', 'app.contact_number', 'app.family', 'app.fee');

	function startTest() {
		$this->FeeBreakdowns =& new TestFeeBreakdownsController();
		$this->FeeBreakdowns->constructClasses();
	}

	function endTest() {
		unset($this->FeeBreakdowns);
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
