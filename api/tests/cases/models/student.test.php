<?php
/* Student Test cases generated on: 2016-02-04 08:58:40 : 1454576320*/
App::import('Model', 'Student');

class StudentTestCase extends CakeTestCase {
	var $fixtures = array('app.student', 'app.educ_level', 'app.year_level', 'app.address', 'app.contact_number', 'app.family');

	function startTest() {
		$this->Student =& ClassRegistry::init('Student');
	}

	function endTest() {
		unset($this->Student);
		ClassRegistry::flush();
	}

}
