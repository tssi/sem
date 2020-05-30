<?php
/* CurriculumDetail Test cases generated on: 2020-05-30 12:19:11 : 1590812351*/
App::import('Model', 'CurriculumDetail');

class CurriculumDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.curriculum_detail', 'app.curriculum', 'app.year_level', 'app.department', 'app.program', 'app.section', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.student', 'app.curriculum_section', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.subject');

	function startTest() {
		$this->CurriculumDetail =& ClassRegistry::init('CurriculumDetail');
	}

	function endTest() {
		unset($this->CurriculumDetail);
		ClassRegistry::flush();
	}

}
