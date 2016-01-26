<?php
/* Family Test cases generated on: 2016-01-26 07:39:04 : 1453790344*/
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
