<?php
/* Religion Test cases generated on: 2016-01-26 07:39:05 : 1453790345*/
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
