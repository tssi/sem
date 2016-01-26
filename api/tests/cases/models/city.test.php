<?php
/* City Test cases generated on: 2016-01-26 06:44:30 : 1453790670*/
App::import('Model', 'City');

class CityTestCase extends CakeTestCase {
	var $fixtures = array('app.city', 'app.province', 'app.barangay');

	function startTest() {
		$this->City =& ClassRegistry::init('City');
	}

	function endTest() {
		unset($this->City);
		ClassRegistry::flush();
	}

}
