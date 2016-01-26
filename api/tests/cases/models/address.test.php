<?php
/* Address Test cases generated on: 2016-01-26 06:52:40 : 1453791160*/
App::import('Model', 'Address');

class AddressTestCase extends CakeTestCase {
	var $fixtures = array('app.address');

	function startTest() {
		$this->Address =& ClassRegistry::init('Address');
	}

	function endTest() {
		unset($this->Address);
		ClassRegistry::flush();
	}

}
