<?php
/* Channel Test cases generated on: 2016-03-02 02:34:59 : 1456886099*/
App::import('Model', 'Webhooks.Channel');

class ChannelTestCase extends CakeTestCase {
	var $fixtures = array('');

	function startTest() {
		$this->Channel =& ClassRegistry::init('Channel');
	}

	function endTest() {
		unset($this->Channel);
		ClassRegistry::flush();
	}

}
