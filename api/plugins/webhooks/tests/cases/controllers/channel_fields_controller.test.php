<?php
/* ChannelFields Test cases generated on: 2016-03-02 02:44:28 : 1456886668*/
App::import('Controller', 'Webhooks.ChannelFields');

class TestChannelFieldsController extends ChannelFieldsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ChannelFieldsControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->ChannelFields =& new TestChannelFieldsController();
		$this->ChannelFields->constructClasses();
	}

	function endTest() {
		unset($this->ChannelFields);
		ClassRegistry::flush();
	}

}
