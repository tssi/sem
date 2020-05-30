<?php
/* Program Test cases generated on: 2020-05-29 10:51:43 : 1590720703*/
App::import('Model', 'Program');

class ProgramTestCase extends CakeTestCase {
	var $fixtures = array('app.program', 'app.department', 'app.section', 'app.user', 'app.year_level');

	function startTest() {
		$this->Program =& ClassRegistry::init('Program');
	}

	function endTest() {
		unset($this->Program);
		ClassRegistry::flush();
	}

}
