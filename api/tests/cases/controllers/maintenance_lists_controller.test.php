<?php
/* MaintenanceLists Test cases generated on: 2016-02-03 06:07:10 : 1454479630*/
App::import('Controller', 'MaintenanceLists');

class TestMaintenanceListsController extends MaintenanceListsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MaintenanceListsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.maintenance_list');

	function startTest() {
		$this->MaintenanceLists =& new TestMaintenanceListsController();
		$this->MaintenanceLists->constructClasses();
	}

	function endTest() {
		unset($this->MaintenanceLists);
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
