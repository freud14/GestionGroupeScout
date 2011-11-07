<?php
/* Adress Test cases generated on: 2011-11-03 16:46:29 : 1320353189*/
App::import('Model', 'Adress');

class AdressTestCase extends CakeTestCase {
	var $fixtures = array('app.adress');

	function startTest() {
		$this->Adress =& ClassRegistry::init('Adress');
	}

	function endTest() {
		unset($this->Adress);
		ClassRegistry::flush();
	}

}
