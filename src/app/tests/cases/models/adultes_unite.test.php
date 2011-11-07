<?php
/* AdultesUnite Test cases generated on: 2011-11-03 16:46:31 : 1320353191*/
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
