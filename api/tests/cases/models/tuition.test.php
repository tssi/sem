<?php
/* Tuition Test cases generated on: 2020-06-09 14:47:56 : 1591685276*/
App::import('Model', 'Tuition');

class TuitionTestCase extends CakeTestCase {
	var $fixtures = array('app.tuition', 'app.year_level', 'app.department', 'app.program', 'app.section', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.student', 'app.curriculum', 'app.curriculum_detail', 'app.subject', 'app.curriculum_section', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.fee_breakdown', 'app.fee');

	function startTest() {
		$this->Tuition =& ClassRegistry::init('Tuition');
	}

	function endTest() {
		unset($this->Tuition);
		ClassRegistry::flush();
	}

}
