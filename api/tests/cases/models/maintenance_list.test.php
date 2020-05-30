<?php
/* MaintenanceList Test cases generated on: 2020-05-29 10:37:30 : 1590719850*/
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
