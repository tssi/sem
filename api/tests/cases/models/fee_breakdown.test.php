<?php
/* FeeBreakdown Test cases generated on: 2020-06-09 14:48:30 : 1591685310*/
App::import('Model', 'FeeBreakdown');

class FeeBreakdownTestCase extends CakeTestCase {
	var $fixtures = array('app.fee_breakdown', 'app.tuition', 'app.year_level', 'app.department', 'app.program', 'app.section', 'app.schedule', 'app.schedule_detail', 'app.room', 'app.student', 'app.curriculum', 'app.curriculum_detail', 'app.subject', 'app.curriculum_section', 'app.user', 'app.user_type', 'app.user_grant', 'app.master_module', 'app.fee');

	function startTest() {
		$this->FeeBreakdown =& ClassRegistry::init('FeeBreakdown');
	}

	function endTest() {
		unset($this->FeeBreakdown);
		ClassRegistry::flush();
	}

}
