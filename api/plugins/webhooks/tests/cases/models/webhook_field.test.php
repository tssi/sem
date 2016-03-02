<?php
/* WebhookField Test cases generated on: 2016-03-02 02:39:49 : 1456886389*/
App::import('Model', 'Webhooks.WebhookField');

class WebhookFieldTestCase extends CakeTestCase {
	function startTest() {
		$this->WebhookField =& ClassRegistry::init('WebhookField');
	}

	function endTest() {
		unset($this->WebhookField);
		ClassRegistry::flush();
	}

}
