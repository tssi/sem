<?php
/* Departments Test cases generated on: 2020-05-29 10:54:37 : 1590720877*/
App::import('Controller', 'Departments');

class TestDepartmentsController extends DepartmentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DepartmentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.department', 'app.program', 'app.section', 'app.year_level', 'app.student', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module');

	function startTest() {
		$this->Departments =& new TestDepartmentsController();
		$this->Departments->constructClasses();
	}

	function endTest() {
		unset($this->Departments);
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
