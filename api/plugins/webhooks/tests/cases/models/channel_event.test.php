<?php
/* ChannelEvent Test cases generated on: 2016-03-02 02:36:22 : 1456886182*/
App::import('Model', 'Webhooks.ChannelEvent');

class ChannelEventTestCase extends CakeTestCase {
	function startTest() {
		$this->ChannelEvent =& ClassRegistry::init('ChannelEvent');
	}

	function endTest() {
		unset($this->ChannelEvent);
		ClassRegistry::flush();
	}

}
