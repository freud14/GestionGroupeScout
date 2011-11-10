<?php
/* FicheMedicalesMedicament Test cases generated on: 2011-11-08 18:38:20 : 1320795500*/
App::import('Model', 'FicheMedicalesMedicament');

class FicheMedicalesMedicamentTestCase extends CakeTestCase {
	var $fixtures = array('app.fiche_medicales_medicament', 'app.medicament', 'app.fiche_medicale', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite', 'app.information_scolaire', 'app.inscription', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.question_generale', 'app.fiche_medicales_question_generale');

	function startTest() {
		$this->FicheMedicalesMedicament =& ClassRegistry::init('FicheMedicalesMedicament');
	}

	function endTest() {
		unset($this->FicheMedicalesMedicament);
		ClassRegistry::flush();
	}

}
