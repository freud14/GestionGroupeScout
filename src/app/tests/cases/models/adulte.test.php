<?php
/* Adulte Test cases generated on: 2011-11-08 14:01:25 : 1320778885*/
App::import('Model', 'Adulte');

class AdulteTestCase extends CakeTestCase {
	var $fixtures = array('app.adulte', 'app.compte', 'app.contact_urgence', 'app.enfant', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite');

	function startTest() {
		$this->Adulte =& ClassRegistry::init('Adulte');
	}

	function endTest() {
		unset($this->Adulte);
		ClassRegistry::flush();
	}

}
