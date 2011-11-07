<?php
/* AdultesEnfant Test cases generated on: 2011-11-03 16:46:30 : 1320353190*/
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
