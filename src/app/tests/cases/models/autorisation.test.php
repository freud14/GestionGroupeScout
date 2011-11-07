<?php
/* Autorisation Test cases generated on: 2011-11-03 16:46:32 : 1320353192*/
App::import('Model', 'Autorisation');

class AutorisationTestCase extends CakeTestCase {
	var $fixtures = array('app.autorisation', 'app.compte', 'app.autorisations_compte');

	function startTest() {
		$this->Autorisation =& ClassRegistry::init('Autorisation');
	}

	function endTest() {
		unset($this->Autorisation);
		ClassRegistry::flush();
	}

}
