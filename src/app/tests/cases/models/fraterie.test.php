<?php
/* Fraterie Test cases generated on: 2011-11-21 11:36:27 : 1321893387*/
App::import('Model', 'Fraterie');

class FraterieTestCase extends CakeTestCase {
	var $fixtures = array('app.fraterie', 'app.facture', 'app.inscription', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.type_sujet', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.groupe_age', 'app.adultes_unite', 'app.fiche_medicale', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale', 'app.information_scolaire', 'app.annee', 'app.nb_versement', 'app.versement', 'app.paiement_type', 'app.paiement');

	function startTest() {
		$this->Fraterie =& ClassRegistry::init('Fraterie');
	}

	function endTest() {
		unset($this->Fraterie);
		ClassRegistry::flush();
	}

}
