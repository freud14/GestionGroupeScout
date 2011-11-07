<?php
/* Fratery Test cases generated on: 2011-11-03 16:46:37 : 1320353197*/
App::import('Model', 'Fratery');

class FrateryTestCase extends CakeTestCase {
	var $fixtures = array('app.fratery');

	function startTest() {
		$this->Fratery =& ClassRegistry::init('Fratery');
	}

	function endTest() {
		unset($this->Fratery);
		ClassRegistry::flush();
	}

}
