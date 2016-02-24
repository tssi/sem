<?php
/* City Test cases generated on: 2016-01-26 06:52:41 : 1453791161*/
App::import('Model', 'City');

class CityTestCase extends CakeTestCase {
	var $fixtures = array('app.city', 'app.province', 'app.country', 'app.barangay');

	function startTest() {
		$this->City =& ClassRegistry::init('City');
	}

	function endTest() {
		unset($this->City);
		ClassRegistry::flush();
	}

}
