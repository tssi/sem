<?php
/* UserGrant Test cases generated on: 2020-05-29 10:54:04 : 1590720844*/
App::import('Model', 'UserGrant');

class UserGrantTestCase extends CakeTestCase {
	var $fixtures = array('app.user_grant', 'app.user_type', 'app.master_module');

	function startTest() {
		$this->UserGrant =& ClassRegistry::init('UserGrant');
	}

	function endTest() {
		unset($this->UserGrant);
		ClassRegistry::flush();
	}

}
