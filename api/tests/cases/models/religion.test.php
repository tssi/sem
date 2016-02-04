<?php
/* Religion Test cases generated on: 2016-02-03 08:14:43 : 1454487283*/
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
