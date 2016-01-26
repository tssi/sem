<?php
/* ContactNumber Test cases generated on: 2016-01-26 07:39:03 : 1453790343*/
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
