<?php
/* UserType Test cases generated on: 2020-05-29 10:54:21 : 1590720861*/
App::import('Model', 'UserType');

class UserTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.user_type', 'app.user_grant', 'app.master_module', 'app.user', 'app.department', 'app.program', 'app.section', 'app.year_level', 'app.student');

	function startTest() {
		$this->UserType =& ClassRegistry::init('UserType');
	}

	function endTest() {
		unset($this->UserType);
		ClassRegistry::flush();
	}

}
