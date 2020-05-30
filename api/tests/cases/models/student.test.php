<?php
/* Student Test cases generated on: 2020-05-29 10:53:42 : 1590720822*/
App::import('Model', 'Student');

class StudentTestCase extends CakeTestCase {
	var $fixtures = array('app.student', 'app.year_level', 'app.department', 'app.program', 'app.section', 'app.user', 'app.user_type');

	function startTest() {
		$this->Student =& ClassRegistry::init('Student');
	}

	function endTest() {
		unset($this->Student);
		ClassRegistry::flush();
	}

}
