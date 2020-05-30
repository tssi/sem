<?php
/* YearLevel Test cases generated on: 2020-05-29 10:53:18 : 1590720798*/
App::import('Model', 'YearLevel');

class YearLevelTestCase extends CakeTestCase {
	var $fixtures = array('app.year_level', 'app.department', 'app.program', 'app.section', 'app.student', 'app.user', 'app.user_type');

	function startTest() {
		$this->YearLevel =& ClassRegistry::init('YearLevel');
	}

	function endTest() {
		unset($this->YearLevel);
		ClassRegistry::flush();
	}

}
