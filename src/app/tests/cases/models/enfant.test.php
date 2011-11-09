<?php
/* Enfant Test cases generated on: 2011-11-08 18:38:18 : 1320795498*/
App::import('Model', 'Enfant');

class EnfantTestCase extends CakeTestCase {
	var $fixtures = array('app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite', 'app.fiche_medicale', 'app.information_scolaire', 'app.inscription');

	function startTest() {
		$this->Enfant =& ClassRegistry::init('Enfant');
	}

	function endTest() {
		unset($this->Enfant);
		ClassRegistry::flush();
	}

}
