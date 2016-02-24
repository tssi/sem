<?php
/* Address Test cases generated on: 2016-02-04 08:58:46 : 1454576326*/
App::import('Model', 'Address');

class AddressTestCase extends CakeTestCase {
	var $fixtures = array('app.address', 'app.student', 'app.educ_level', 'app.year_level', 'app.contact_number', 'app.family');

	function startTest() {
		$this->Address =& ClassRegistry::init('Address');
	}

	function endTest() {
		unset($this->Address);
		ClassRegistry::flush();
	}

}
