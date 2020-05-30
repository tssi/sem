<?php
/* CurriculumSection Test cases generated on: 2020-05-30 12:19:26 : 1590812366*/
App::import('Model', 'CurriculumSection');

class CurriculumSectionTestCase extends CakeTestCase {
	var $fixtures = array('app.curriculum_section', 'app.section', 'app.department', 'app.program', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.year_level', 'app.student', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.curriculum');

	function startTest() {
		$this->CurriculumSection =& ClassRegistry::init('CurriculumSection');
	}

	function endTest() {
		unset($this->CurriculumSection);
		ClassRegistry::flush();
	}

}
