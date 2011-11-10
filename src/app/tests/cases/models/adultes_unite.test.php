<?php
/* AdultesUnite Test cases generated on: 2011-11-08 18:38:14 : 1320795494*/
App::import('Model', 'AdultesUnite');

class AdultesUniteTestCase extends CakeTestCase {
	var $fixtures = array('app.adultes_unite', 'app.adulte', 'app.compte', 'app.contact_urgence', 'app.enfant', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite');

	function startTest() {
		$this->AdultesUnite =& ClassRegistry::init('AdultesUnite');
	}

	function endTest() {
		unset($this->AdultesUnite);
		ClassRegistry::flush();
	}

}
