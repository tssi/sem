<?php
/* User Test cases generated on: 2020-05-29 10:52:35 : 1590720755*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.user_type', 'app.department', 'app.program', 'app.section', 'app.year_level', 'app.student');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
