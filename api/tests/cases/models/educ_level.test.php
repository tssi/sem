<?php
/* EducLevel Test cases generated on: 2016-01-26 06:52:43 : 1453791163*/
App::import('Model', 'EducLevel');

class EducLevelTestCase extends CakeTestCase {
	var $fixtures = array('app.educ_level', 'app.student', 'app.year_level', 'app.family');

	function startTest() {
		$this->EducLevel =& ClassRegistry::init('EducLevel');
	}

	function endTest() {
		unset($this->EducLevel);
		ClassRegistry::flush();
	}

}
