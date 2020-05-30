<?php
/* UserGrants Test cases generated on: 2020-05-29 10:56:15 : 1590720975*/
App::import('Controller', 'UserGrants');

class TestUserGrantsController extends UserGrantsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class UserGrantsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.user_grant', 'app.user_type', 'app.user', 'app.department', 'app.program', 'app.section', 'app.year_level', 'app.student', 'app.master_module');

	function startTest() {
		$this->UserGrants =& new TestUserGrantsController();
		$this->UserGrants->constructClasses();
	}

	function endTest() {
		unset($this->UserGrants);
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
