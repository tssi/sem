<?php
/* PaymentDueDate Test cases generated on: 2020-06-11 11:36:03 : 1591846563*/
App::import('Model', 'PaymentDueDate');

class PaymentDueDateTestCase extends CakeTestCase {
	var $fixtures = array('app.payment_due_date', 'app.scheme');

	function startTest() {
		$this->PaymentDueDate =& ClassRegistry::init('PaymentDueDate');
	}

	function endTest() {
		unset($this->PaymentDueDate);
		ClassRegistry::flush();
	}

}
