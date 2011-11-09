<?php
/* PaiementType Test cases generated on: 2011-11-08 18:38:27 : 1320795507*/
App::import('Model', 'PaiementType');

class PaiementTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.paiement_type', 'app.paiement');

	function startTest() {
		$this->PaiementType =& ClassRegistry::init('PaiementType');
	}

	function endTest() {
		unset($this->PaiementType);
		ClassRegistry::flush();
	}

}
