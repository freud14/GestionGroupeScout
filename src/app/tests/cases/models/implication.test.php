<?php
/* Implication Test cases generated on: 2011-11-08 14:01:35 : 1320778895*/
App::import('Model', 'Implication');

class ImplicationTestCase extends CakeTestCase {
	var $fixtures = array('app.implication', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.comptes_notification', 'app.contact_urgence', 'app.enfant', 'app.adresse', 'app.fiche_medicale', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale', 'app.information_scolaire', 'app.inscription', 'app.adultes_enfant', 'app.adultes_implication', 'app.unite', 'app.adultes_unite');

	function startTest() {
		$this->Implication =& ClassRegistry::init('Implication');
	}

	function endTest() {
		unset($this->Implication);
		ClassRegistry::flush();
	}

}
