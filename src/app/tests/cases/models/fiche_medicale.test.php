<?php
/* FicheMedicale Test cases generated on: 2011-11-21 11:36:25 : 1321893385*/
App::import('Model', 'FicheMedicale');

class FicheMedicaleTestCase extends CakeTestCase {
	var $fixtures = array('app.fiche_medicale', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.type_sujet', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.groupe_age', 'app.inscription', 'app.annee', 'app.facture', 'app.nb_versement', 'app.versement', 'app.fraterie', 'app.paiement_type', 'app.paiement', 'app.adultes_unite', 'app.information_scolaire', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale');

	function startTest() {
		$this->FicheMedicale =& ClassRegistry::init('FicheMedicale');
	}

	function endTest() {
		unset($this->FicheMedicale);
		ClassRegistry::flush();
	}

}
