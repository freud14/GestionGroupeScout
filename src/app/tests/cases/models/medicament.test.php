<?php
/* Medicament Test cases generated on: 2011-11-21 11:36:30 : 1321893390*/
App::import('Model', 'Medicament');

class MedicamentTestCase extends CakeTestCase {
	var $fixtures = array('app.medicament', 'app.fiche_medicale', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.type_sujet', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.groupe_age', 'app.inscription', 'app.annee', 'app.facture', 'app.nb_versement', 'app.versement', 'app.fraterie', 'app.paiement_type', 'app.paiement', 'app.adultes_unite', 'app.information_scolaire', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale');

	function startTest() {
		$this->Medicament =& ClassRegistry::init('Medicament');
	}

	function endTest() {
		unset($this->Medicament);
		ClassRegistry::flush();
	}

}
