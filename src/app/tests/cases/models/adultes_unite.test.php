<?php
/* AdultesUnite Test cases generated on: 2011-11-08 14:01:26 : 1320778886*/
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
