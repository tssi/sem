<?php
/* MasterModule Test cases generated on: 2020-05-29 10:03:56 : 1590717836*/
App::import('Model', 'MasterModule');

class MasterModuleTestCase extends CakeTestCase {
	var $fixtures = array('app.master_module', 'app.user_grant');

	function startTest() {
		$this->MasterModule =& ClassRegistry::init('MasterModule');
	}

	function endTest() {
		unset($this->MasterModule);
		ClassRegistry::flush();
	}

}
