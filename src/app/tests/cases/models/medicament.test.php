<?php
/* Medicament Test cases generated on: 2011-11-03 16:46:40 : 1320353200*/
App::import('Model', 'Medicament');

class MedicamentTestCase extends CakeTestCase {
	var $fixtures = array('app.medicament', 'app.fiche_medicale', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite', 'app.information_scolaire', 'app.inscription', 'app.groupe_age', 'app.annee', 'app.facture', 'app.nb_versement', 'app.fraterie', 'app.paiement', 'app.prescription', 'app.malady', 'app.fiche_medicales_malady', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale');

	function startTest() {
		$this->Medicament =& ClassRegistry::init('Medicament');
	}

	function endTest() {
		unset($this->Medicament);
		ClassRegistry::flush();
	}

}
