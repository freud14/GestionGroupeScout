<?php
/* Autorisation Test cases generated on: 2011-11-08 18:38:15 : 1320795495*/
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
