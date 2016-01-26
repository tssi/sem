<?php
/* Religion Test cases generated on: 2016-01-26 06:52:45 : 1453791165*/
App::import('Model', 'Religion');

class ReligionTestCase extends CakeTestCase {
	var $fixtures = array('app.religion');

	function startTest() {
		$this->Religion =& ClassRegistry::init('Religion');
	}

	function endTest() {
		unset($this->Religion);
		ClassRegistry::flush();
	}

}
