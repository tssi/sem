<?php
/* Family Test cases generated on: 2016-01-26 06:52:44 : 1453791164*/
App::import('Model', 'Family');

class FamilyTestCase extends CakeTestCase {
	var $fixtures = array('app.family', 'app.student', 'app.educ_level', 'app.year_level');

	function startTest() {
		$this->Family =& ClassRegistry::init('Family');
	}

	function endTest() {
		unset($this->Family);
		ClassRegistry::flush();
	}

}
