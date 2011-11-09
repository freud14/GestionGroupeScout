<?php
/* Annee Test cases generated on: 2011-11-08 18:38:14 : 1320795494*/
App::import('Model', 'Annee');

class AnneeTestCase extends CakeTestCase {
	var $fixtures = array('app.annee', 'app.inscription');

	function startTest() {
		$this->Annee =& ClassRegistry::init('Annee');
	}

	function endTest() {
		unset($this->Annee);
		ClassRegistry::flush();
	}

}
