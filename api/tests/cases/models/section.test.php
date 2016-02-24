<?php
/* Section Test cases generated on: 2016-02-05 04:13:18 : 1454645598*/
App::import('Model', 'Section');

class SectionTestCase extends CakeTestCase {
	var $fixtures = array('app.section', 'app.year_level', 'app.educ_level', 'app.student', 'app.address', 'app.contact_number', 'app.family');

	function startTest() {
		$this->Section =& ClassRegistry::init('Section');
	}

	function endTest() {
		unset($this->Section);
		ClassRegistry::flush();
	}

}
