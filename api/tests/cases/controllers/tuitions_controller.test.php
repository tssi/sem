<?php
/* Tuitions Test cases generated on: 2016-02-05 01:00:32 : 1454634032*/
App::import('Controller', 'Tuitions');

class TestTuitionsController extends TuitionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TuitionsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.tuition', 'app.year_level', 'app.educ_level', 'app.student', 'app.address', 'app.contact_number', 'app.family');

	function startTest() {
		$this->Tuitions =& new TestTuitionsController();
		$this->Tuitions->constructClasses();
	}

	function endTest() {
		unset($this->Tuitions);
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
