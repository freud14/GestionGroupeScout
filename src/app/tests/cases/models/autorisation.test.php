<?php
/* Autorisation Test cases generated on: 2011-11-21 11:36:22 : 1321893382*/
App::import('Model', 'Autorisation');

class AutorisationTestCase extends CakeTestCase {
	var $fixtures = array('app.autorisation', 'app.compte', 'app.adulte', 'app.contact_urgence', 'app.enfant', 'app.adresse', 'app.fiche_medicale', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale', 'app.information_scolaire', 'app.inscription', 'app.groupe_age', 'app.unite', 'app.adultes_unite', 'app.annee', 'app.facture', 'app.nb_versement', 'app.versement', 'app.fraterie', 'app.paiement_type', 'app.paiement', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.autorisations_compte', 'app.notification', 'app.type_sujet', 'app.comptes_notification');

	function startTest() {
		$this->Autorisation =& ClassRegistry::init('Autorisation');
	}

	function endTest() {
		unset($this->Autorisation);
		ClassRegistry::flush();
	}

}
