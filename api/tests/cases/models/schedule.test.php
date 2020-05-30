<?php
/* Schedule Test cases generated on: 2020-05-29 21:56:21 : 1590760581*/
App::import('Model', 'Schedule');

class ScheduleTestCase extends CakeTestCase {
	var $fixtures = array('app.schedule', 'app.section', 'app.department', 'app.program', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.year_level', 'app.student', 'app.curriculum', 'app.curriculum_section', 'app.schedule_detail', 'app.room');

	function startTest() {
		$this->Schedule =& ClassRegistry::init('Schedule');
	}

	function endTest() {
		unset($this->Schedule);
		ClassRegistry::flush();
	}

}
