<?php
/* Webhook Test cases generated on: 2016-03-02 02:39:35 : 1456886375*/
App::import('Model', 'Webhooks.Webhook');

class WebhookTestCase extends CakeTestCase {
	function startTest() {
		$this->Webhook =& ClassRegistry::init('Webhook');
	}

	function endTest() {
		unset($this->Webhook);
		ClassRegistry::flush();
	}

}
