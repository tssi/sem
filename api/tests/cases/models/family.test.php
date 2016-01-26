<?php
/* Family Test cases generated on: 2016-01-26 06:44:31 : 1453790671*/
App::import('Model', 'Family');

class FamilyTestCase extends CakeTestCase {
	var $fixtures = array('app.family', 'app.student');

	function startTest() {
		$this->Family =& ClassRegistry::init('Family');
	}

	function endTest() {
		unset($this->Family);
		ClassRegistry::flush();
	}

}
