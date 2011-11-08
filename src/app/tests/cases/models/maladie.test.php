<?php
/* Maladie Test cases generated on: 2011-11-08 14:01:37 : 1320778897*/
App::import('Model', 'Maladie');

class MaladieTestCase extends CakeTestCase {
	var $fixtures = array('app.maladie', 'app.fiche_medicale', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite', 'app.information_scolaire', 'app.inscription', 'app.groupe_age', 'app.annee', 'app.facture', 'app.nb_versement', 'app.fraterie', 'app.versement', 'app.paiement', 'app.prescription', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale');

	function startTest() {
		$this->Maladie =& ClassRegistry::init('Maladie');
	}

	function endTest() {
		unset($this->Maladie);
		ClassRegistry::flush();
	}

}
