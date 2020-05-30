<?php
/* MasterConfigs Test cases generated on: 2020-05-29 10:55:05 : 1590720905*/
App::import('Controller', 'MasterConfigs');

class TestMasterConfigsController extends MasterConfigsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MasterConfigsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.master_config');

	function startTest() {
		$this->MasterConfigs =& new TestMasterConfigsController();
		$this->MasterConfigs->constructClasses();
	}

	function endTest() {
		unset($this->MasterConfigs);
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
