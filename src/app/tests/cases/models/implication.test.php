<?php
/* Implication Test cases generated on: 2011-11-21 11:36:28 : 1321893388*/
App::import('Model', 'Implication');

class ImplicationTestCase extends CakeTestCase {
	var $fixtures = array('app.implication', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.type_sujet', 'app.comptes_notification', 'app.contact_urgence', 'app.enfant', 'app.adresse', 'app.fiche_medicale', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale', 'app.information_scolaire', 'app.inscription', 'app.groupe_age', 'app.unite', 'app.adultes_unite', 'app.annee', 'app.facture', 'app.nb_versement', 'app.versement', 'app.fraterie', 'app.paiement_type', 'app.paiement', 'app.adultes_enfant', 'app.adultes_implication');

	function startTest() {
		$this->Implication =& ClassRegistry::init('Implication');
	}

	function endTest() {
		unset($this->Implication);
		ClassRegistry::flush();
	}

}
