<?php
/* Curriculum Test cases generated on: 2020-05-30 12:19:41 : 1590812381*/
App::import('Model', 'Curriculum');

class CurriculumTestCase extends CakeTestCase {
	var $fixtures = array('app.curriculum', 'app.department', 'app.program', 'app.section', 'app.year_level', 'app.student', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.curriculum_section', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.curriculum_detail', 'app.subject');

	function startTest() {
		$this->Curriculum =& ClassRegistry::init('Curriculum');
	}

	function endTest() {
		unset($this->Curriculum);
		ClassRegistry::flush();
	}

}
