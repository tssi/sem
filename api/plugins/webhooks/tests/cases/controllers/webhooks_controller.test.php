<?php
/* Webhooks Test cases generated on: 2016-03-02 02:44:58 : 1456886698*/
App::import('Controller', 'Webhooks.Webhooks');

class TestWebhooksController extends WebhooksController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class WebhooksControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->Webhooks =& new TestWebhooksController();
		$this->Webhooks->constructClasses();
	}

	function endTest() {
		unset($this->Webhooks);
		ClassRegistry::flush();
	}

}
