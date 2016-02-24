<?php
/* SystemDefault Test cases generated on: 2016-02-21 02:26:16 : 1456021576*/
App::import('Model', 'SystemDefault');

class SystemDefaultTestCase extends CakeTestCase {
	var $fixtures = array('app.system_default');

	function startTest() {
		$this->SystemDefault =& ClassRegistry::init('SystemDefault');
	}

	function endTest() {
		unset($this->SystemDefault);
		ClassRegistry::flush();
	}

}
