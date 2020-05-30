<?php
/* Department Test cases generated on: 2020-05-29 10:51:00 : 1590720660*/
App::import('Model', 'Department');

class DepartmentTestCase extends CakeTestCase {
	var $fixtures = array('app.department', 'app.program', 'app.section', 'app.user', 'app.year_level');

	function startTest() {
		$this->Department =& ClassRegistry::init('Department');
	}

	function endTest() {
		unset($this->Department);
		ClassRegistry::flush();
	}

}
