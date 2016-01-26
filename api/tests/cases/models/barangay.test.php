<?php
/* Barangay Test cases generated on: 2016-01-26 06:52:41 : 1453791161*/
App::import('Model', 'Barangay');

class BarangayTestCase extends CakeTestCase {
	var $fixtures = array('app.barangay', 'app.city', 'app.province', 'app.country');

	function startTest() {
		$this->Barangay =& ClassRegistry::init('Barangay');
	}

	function endTest() {
		unset($this->Barangay);
		ClassRegistry::flush();
	}

}
