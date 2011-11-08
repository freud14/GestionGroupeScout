<?php
/* AutorisationsCompte Test cases generated on: 2011-11-08 14:01:28 : 1320778888*/
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
