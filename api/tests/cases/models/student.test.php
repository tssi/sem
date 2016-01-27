<?php
/* Student Test cases generated on: 2016-01-26 06:52:45 : 1453791165*/
App::import('Model', 'Student');

class StudentTestCase extends CakeTestCase {
	var $fixtures = array('app.student', 'app.educ_level', 'app.year_level', 'app.family');

	function startTest() {
		$this->Student =& ClassRegistry::init('Student');
	}

	function endTest() {
		unset($this->Student);
		ClassRegistry::flush();
	}

}
