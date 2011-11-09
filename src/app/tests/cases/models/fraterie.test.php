<?php
/* Fraterie Test cases generated on: 2011-11-08 18:38:21 : 1320795501*/
App::import('Model', 'Fraterie');

class FraterieTestCase extends CakeTestCase {
	var $fixtures = array('app.fraterie', 'app.facture', 'app.inscription', 'app.nb_versement', 'app.paiement', 'app.versement');

	function startTest() {
		$this->Fraterie =& ClassRegistry::init('Fraterie');
	}

	function endTest() {
		unset($this->Fraterie);
		ClassRegistry::flush();
	}

}
