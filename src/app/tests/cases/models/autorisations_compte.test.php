<?php
/* AutorisationsCompte Test cases generated on: 2011-11-08 18:38:16 : 1320795496*/
App::import('Model', 'AutorisationsCompte');

class AutorisationsCompteTestCase extends CakeTestCase {
	var $fixtures = array('app.autorisations_compte', 'app.autorisation', 'app.compte');

	function startTest() {
		$this->AutorisationsCompte =& ClassRegistry::init('AutorisationsCompte');
	}

	function endTest() {
		unset($this->AutorisationsCompte);
		ClassRegistry::flush();
	}

}
