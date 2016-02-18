<?php
/* Programs Test cases generated on: 2016-02-18 07:50:00 : 1455781800*/
App::import('Controller', 'Programs');

class TestProgramsController extends ProgramsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ProgramsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.program');

	function startTest() {
		$this->Programs =& new TestProgramsController();
		$this->Programs->constructClasses();
	}

	function endTest() {
		unset($this->Programs);
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
