<?php
/* ContactNumber Test cases generated on: 2016-01-26 06:44:30 : 1453790670*/
App::import('Model', 'ContactNumber');

class ContactNumberTestCase extends CakeTestCase {
	var $fixtures = array('app.contact_number');

	function startTest() {
		$this->ContactNumber =& ClassRegistry::init('ContactNumber');
	}

	function endTest() {
		unset($this->ContactNumber);
		ClassRegistry::flush();
	}

}
