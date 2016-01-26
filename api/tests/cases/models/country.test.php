<?php
/* Country Test cases generated on: 2016-01-26 06:44:31 : 1453790671*/
App::import('Model', 'Country');

class CountryTestCase extends CakeTestCase {
	var $fixtures = array('app.country', 'app.province');

	function startTest() {
		$this->Country =& ClassRegistry::init('Country');
	}

	function endTest() {
		unset($this->Country);
		ClassRegistry::flush();
	}

}
