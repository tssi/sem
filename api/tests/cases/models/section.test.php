<?php
/* Section Test cases generated on: 2020-05-29 21:44:55 : 1590759895*/
App::import('Model', 'Section');

class SectionTestCase extends CakeTestCase {
	var $fixtures = array('app.section', 'app.department', 'app.program', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.year_level', 'app.student', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.curriculum', 'app.curriculum_section');

	function startTest() {
		$this->Section =& ClassRegistry::init('Section');
	}

	function endTest() {
		unset($this->Section);
		ClassRegistry::flush();
	}

}
