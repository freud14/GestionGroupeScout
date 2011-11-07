<?php
/* Facture Test cases generated on: 2011-11-03 16:46:35 : 1320353195*/
App::import('Model', 'Facture');

class FactureTestCase extends CakeTestCase {
	var $fixtures = array('app.facture', 'app.inscription', 'app.nb_versement', 'app.fraterie', 'app.paiement');

	function startTest() {
		$this->Facture =& ClassRegistry::init('Facture');
	}

	function endTest() {
		unset($this->Facture);
		ClassRegistry::flush();
	}

}
