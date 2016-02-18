<?php
/* Discount Test cases generated on: 2016-02-05 01:00:11 : 1454634011*/
App::import('Model', 'Discount');

class DiscountTestCase extends CakeTestCase {
	var $fixtures = array('app.discount');

	function startTest() {
		$this->Discount =& ClassRegistry::init('Discount');
	}

	function endTest() {
		unset($this->Discount);
		ClassRegistry::flush();
	}

}
