<?php
/* Adresse Test cases generated on: 2011-11-08 18:38:12 : 1320795492*/
App::import('Model', 'Adresse');

class AdresseTestCase extends CakeTestCase {
	var $fixtures = array('app.adresse', 'app.enfant');

	function startTest() {
		$this->Adresse =& ClassRegistry::init('Adresse');
	}

	function endTest() {
		unset($this->Adresse);
		ClassRegistry::flush();
	}

}
