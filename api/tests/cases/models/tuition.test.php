<?php
/* Tuition Test cases generated on: 2016-02-05 01:00:05 : 1454634005*/
App::import('Model', 'Tuition');

class TuitionTestCase extends CakeTestCase {
	var $fixtures = array('app.tuition', 'app.year_level', 'app.educ_level', 'app.student', 'app.address', 'app.contact_number', 'app.family');

	function startTest() {
		$this->Tuition =& ClassRegistry::init('Tuition');
	}

	function endTest() {
		unset($this->Tuition);
		ClassRegistry::flush();
	}

}
