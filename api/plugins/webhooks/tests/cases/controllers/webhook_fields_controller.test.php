<?php
/* WebhookFields Test cases generated on: 2016-03-02 02:45:12 : 1456886712*/
App::import('Controller', 'Webhooks.WebhookFields');

class TestWebhookFieldsController extends WebhookFieldsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class WebhookFieldsControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->WebhookFields =& new TestWebhookFieldsController();
		$this->WebhookFields->constructClasses();
	}

	function endTest() {
		unset($this->WebhookFields);
		ClassRegistry::flush();
	}

}
