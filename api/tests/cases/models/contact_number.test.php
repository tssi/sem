<?php
/* ContactNumber Test cases generated on: 2016-02-04 08:58:52 : 1454576332*/
App::import('Model', 'ContactNumber');

class ContactNumberTestCase extends CakeTestCase {
	var $fixtures = array('app.contact_number', 'app.student', 'app.educ_level', 'app.year_level', 'app.address', 'app.family');

	function startTest() {
		$this->ContactNumber =& ClassRegistry::init('ContactNumber');
	}

	function endTest() {
		unset($this->ContactNumber);
		ClassRegistry::flush();
	}

}
