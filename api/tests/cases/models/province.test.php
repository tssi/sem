<?php
/* Province Test cases generated on: 2016-01-26 06:44:32 : 1453790672*/
App::import('Model', 'Province');

class ProvinceTestCase extends CakeTestCase {
	var $fixtures = array('app.province', 'app.country', 'app.city', 'app.barangay');

	function startTest() {
		$this->Province =& ClassRegistry::init('Province');
	}

	function endTest() {
		unset($this->Province);
		ClassRegistry::flush();
	}

}
