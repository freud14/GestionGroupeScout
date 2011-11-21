<?php
/* AdultesUnite Test cases generated on: 2011-11-21 11:36:21 : 1321893381*/
App::import('Model', 'AdultesUnite');

class AdultesUniteTestCase extends CakeTestCase {
	var $fixtures = array('app.adultes_unite', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.type_sujet', 'app.comptes_notification', 'app.contact_urgence', 'app.enfant', 'app.adresse', 'app.fiche_medicale', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale', 'app.information_scolaire', 'app.inscription', 'app.groupe_age', 'app.unite', 'app.annee', 'app.facture', 'app.nb_versement', 'app.versement', 'app.fraterie', 'app.paiement_type', 'app.paiement', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication');

	function startTest() {
		$this->AdultesUnite =& ClassRegistry::init('AdultesUnite');
	}

	function endTest() {
		unset($this->AdultesUnite);
		ClassRegistry::flush();
	}

}
