<?php
/* YearLevel Test cases generated on: 2016-01-26 06:52:46 : 1453791166*/
App::import('Model', 'YearLevel');

class YearLevelTestCase extends CakeTestCase {
	var $fixtures = array('app.year_level', 'app.educ_level', 'app.student', 'app.family');

	function startTest() {
		$this->YearLevel =& ClassRegistry::init('YearLevel');
	}

	function endTest() {
		unset($this->YearLevel);
		ClassRegistry::flush();
	}

}
