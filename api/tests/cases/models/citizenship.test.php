<?php
/* Citizenship Test cases generated on: 2016-01-27 07:03:46 : 1453878226*/
App::import('Model', 'Citizenship');

class CitizenshipTestCase extends CakeTestCase {
	var $fixtures = array('app.citizenship');

	function startTest() {
		$this->Citizenship =& ClassRegistry::init('Citizenship');
	}

	function endTest() {
		unset($this->Citizenship);
		ClassRegistry::flush();
	}

}
