<?php
/* Paiement Test cases generated on: 2011-11-08 18:38:28 : 1320795508*/
App::import('Model', 'Paiement');

class PaiementTestCase extends CakeTestCase {
	var $fixtures = array('app.paiement', 'app.facture', 'app.inscription', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.type_sujet', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite', 'app.fiche_medicale', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale', 'app.information_scolaire', 'app.groupe_age', 'app.annee', 'app.nb_versement', 'app.versement', 'app.fraterie', 'app.paiement_type');

	function startTest() {
		$this->Paiement =& ClassRegistry::init('Paiement');
	}

	function endTest() {
		unset($this->Paiement);
		ClassRegistry::flush();
	}

}
