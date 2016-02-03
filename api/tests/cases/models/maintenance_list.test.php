<?php
/* MaintenanceList Test cases generated on: 2016-02-03 06:07:00 : 1454479620*/
App::import('Model', 'MaintenanceList');

class MaintenanceListTestCase extends CakeTestCase {
	var $fixtures = array('app.maintenance_list');

	function startTest() {
		$this->MaintenanceList =& ClassRegistry::init('MaintenanceList');
	}

	function endTest() {
		unset($this->MaintenanceList);
		ClassRegistry::flush();
	}

}
