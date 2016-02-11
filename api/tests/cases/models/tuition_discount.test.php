<?php
/* TuitionDiscount Test cases generated on: 2016-02-11 02:29:04 : 1455157744*/
App::import('Model', 'TuitionDiscount');

class TuitionDiscountTestCase extends CakeTestCase {
	var $fixtures = array('app.tuition_discount', 'app.tuition', 'app.year_level', 'app.educ_level', 'app.student', 'app.address', 'app.contact_number', 'app.family', 'app.fee_breakdown', 'app.fee', 'app.payment_scheme', 'app.scheme', 'app.payment_scheme_schedule', 'app.discount');

	function startTest() {
		$this->TuitionDiscount =& ClassRegistry::init('TuitionDiscount');
	}

	function endTest() {
		unset($this->TuitionDiscount);
		ClassRegistry::flush();
	}

}
