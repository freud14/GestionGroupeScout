<?php
/* AdultesEnfant Test cases generated on: 2011-11-08 18:38:13 : 1320795493*/
App::import('Model', 'AdultesEnfant');

class AdultesEnfantTestCase extends CakeTestCase {
	var $fixtures = array('app.adultes_enfant', 'app.adulte', 'app.compte', 'app.contact_urgence', 'app.enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite');

	function startTest() {
		$this->AdultesEnfant =& ClassRegistry::init('AdultesEnfant');
	}

	function endTest() {
		unset($this->AdultesEnfant);
		ClassRegistry::flush();
	}

}
