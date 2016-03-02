<?php
/* Channels Test cases generated on: 2016-03-02 02:43:53 : 1456886633*/
App::import('Controller', 'Webhooks.Channels');

class TestChannelsController extends ChannelsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ChannelsControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->Channels =& new TestChannelsController();
		$this->Channels->constructClasses();
	}

	function endTest() {
		unset($this->Channels);
		ClassRegistry::flush();
	}

}
