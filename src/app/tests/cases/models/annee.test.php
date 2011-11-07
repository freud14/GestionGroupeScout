<?php
/* Annee Test cases generated on: 2011-11-03 16:46:31 : 1320353191*/
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
