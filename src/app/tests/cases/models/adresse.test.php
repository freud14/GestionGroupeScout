<?php
/* Adresse Test cases generated on: 2011-11-08 14:01:24 : 1320778884*/
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
