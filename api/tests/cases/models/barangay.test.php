<?php
/* Barangay Test cases generated on: 2016-01-26 06:44:29 : 1453790669*/
App::import('Model', 'Barangay');

class BarangayTestCase extends CakeTestCase {
	var $fixtures = array('app.barangay', 'app.city');

	function startTest() {
		$this->Barangay =& ClassRegistry::init('Barangay');
	}

	function endTest() {
		unset($this->Barangay);
		ClassRegistry::flush();
	}

}
