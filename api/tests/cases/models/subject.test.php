<?php
/* Subject Test cases generated on: 2020-06-08 15:56:17 : 1591602977*/
App::import('Model', 'Subject');

class SubjectTestCase extends CakeTestCase {
	var $fixtures = array('app.subject', 'app.department', 'app.program', 'app.section', 'app.year_level', 'app.student', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.curriculum', 'app.curriculum_detail', 'app.curriculum_section', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module');

	function startTest() {
		$this->Subject =& ClassRegistry::init('Subject');
	}

	function endTest() {
		unset($this->Subject);
		ClassRegistry::flush();
	}

}
