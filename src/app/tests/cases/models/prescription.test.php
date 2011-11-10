<?php
/* Prescription Test cases generated on: 2011-11-08 18:38:28 : 1320795508*/
App::import('Model', 'Prescription');

class PrescriptionTestCase extends CakeTestCase {
	var $fixtures = array('app.prescription', 'app.fiche_medicale', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.type_sujet', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite', 'app.information_scolaire', 'app.inscription', 'app.groupe_age', 'app.annee', 'app.facture', 'app.nb_versement', 'app.versement', 'app.fraterie', 'app.paiement', 'app.paiement_type', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale');

	function startTest() {
		$this->Prescription =& ClassRegistry::init('Prescription');
	}

	function endTest() {
		unset($this->Prescription);
		ClassRegistry::flush();
	}

}
