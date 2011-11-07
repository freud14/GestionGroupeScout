<?php
/* Compte Test cases generated on: 2011-11-03 16:46:33 : 1320353193*/
App::import('Model', 'Compte');

class CompteTestCase extends CakeTestCase {
	var $fixtures = array('app.compte', 'app.adulte', 'app.contact_urgence', 'app.enfant', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.comptes_notification');

	function startTest() {
		$this->Compte =& ClassRegistry::init('Compte');
	}

	function endTest() {
		unset($this->Compte);
		ClassRegistry::flush();
	}

}
