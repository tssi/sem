<?php
/* UserTypes Test cases generated on: 2020-05-29 10:56:25 : 1590720985*/
App::import('Controller', 'UserTypes');

class TestUserTypesController extends UserTypesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UserTypesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.user_type', 'app.user_grant', 'app.master_module', 'app.user', 'app.department', 'app.program', 'app.section', 'app.year_level', 'app.student');

	function startTest() {
		$this->UserTypes =& new TestUserTypesController();
		$this->UserTypes->constructClasses();
	}

	function endTest() {
		unset($this->UserTypes);
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
