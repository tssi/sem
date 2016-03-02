<?php
/* ChannelEvents Test cases generated on: 2016-03-02 02:44:40 : 1456886680*/
App::import('Controller', 'Webhooks.ChannelEvents');

class TestChannelEventsController extends ChannelEventsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ChannelEventsControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->ChannelEvents =& new TestChannelEventsController();
		$this->ChannelEvents->constructClasses();
	}

	function endTest() {
		unset($this->ChannelEvents);
		ClassRegistry::flush();
	}

}
