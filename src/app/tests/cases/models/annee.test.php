<?php
/* Annee Test cases generated on: 2011-11-08 14:01:27 : 1320778887*/
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
