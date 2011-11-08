<?php
/* Inscription Test cases generated on: 2011-11-08 14:01:36 : 1320778896*/
App::import('Model', 'Inscription');

class InscriptionTestCase extends CakeTestCase {
	var $fixtures = array('app.inscription', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite', 'app.fiche_medicale', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale', 'app.information_scolaire', 'app.groupe_age', 'app.annee', 'app.facture', 'app.nb_versement', 'app.fraterie', 'app.versement', 'app.paiement');

	function startTest() {
		$this->Inscription =& ClassRegistry::init('Inscription');
	}

	function endTest() {
		unset($this->Inscription);
		ClassRegistry::flush();
	}

}
