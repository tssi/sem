<?php
/* BillingPeriod Test cases generated on: 2016-02-05 08:11:19 : 1454659879*/
App::import('Model', 'BillingPeriod');

class BillingPeriodTestCase extends CakeTestCase {
	var $fixtures = array('app.billing_period');

	function startTest() {
		$this->BillingPeriod =& ClassRegistry::init('BillingPeriod');
	}

	function endTest() {
		unset($this->BillingPeriod);
		ClassRegistry::flush();
	}

}
