<?php
/* Scheme Test cases generated on: 2016-02-05 01:00:16 : 1454634016*/
App::import('Model', 'Scheme');

class SchemeTestCase extends CakeTestCase {
	var $fixtures = array('app.scheme');

	function startTest() {
		$this->Scheme =& ClassRegistry::init('Scheme');
	}

	function endTest() {
		unset($this->Scheme);
		ClassRegistry::flush();
	}

}
