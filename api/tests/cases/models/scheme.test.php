<?php
/* Scheme Test cases generated on: 2020-06-11 11:35:47 : 1591846547*/
App::import('Model', 'Scheme');

class SchemeTestCase extends CakeTestCase {
	var $fixtures = array('app.scheme', 'app.payment_due_date');

	function startTest() {
		$this->Scheme =& ClassRegistry::init('Scheme');
	}

	function endTest() {
		unset($this->Scheme);
		ClassRegistry::flush();
	}

}
