<?php
/* ChannelField Test cases generated on: 2016-03-02 02:35:38 : 1456886138*/
App::import('Model', 'Webhooks.ChannelField');

class ChannelFieldTestCase extends CakeTestCase {
	function startTest() {
		$this->ChannelField =& ClassRegistry::init('ChannelField');
	}

	function endTest() {
		unset($this->ChannelField);
		ClassRegistry::flush();
	}

}
