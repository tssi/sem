<?php
/* Fee Test cases generated on: 2020-06-09 14:48:57 : 1591685337*/
App::import('Model', 'Fee');

class FeeTestCase extends CakeTestCase {
	var $fixtures = array('app.fee', 'app.fee_breakdown', 'app.tuition', 'app.year_level', 'app.department', 'app.program', 'app.section', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.student', 'app.curriculum', 'app.curriculum_detail', 'app.subject', 'app.curriculum_section', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module');

	function startTest() {
		$this->Fee =& ClassRegistry::init('Fee');
	}

	function endTest() {
		unset($this->Fee);
		ClassRegistry::flush();
	}

}
