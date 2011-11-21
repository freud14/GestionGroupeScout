<?php
/* FicheMedicalesMalady Test cases generated on: 2011-11-21 11:36:26 : 1321893386*/
App::import('Model', 'FicheMedicalesMalady');

class FicheMedicalesMaladyTestCase extends CakeTestCase {
	var $fixtures = array('app.fiche_medicales_malady', 'app.maladie', 'app.fiche_medicale', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.type_sujet', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.groupe_age', 'app.inscription', 'app.annee', 'app.facture', 'app.nb_versement', 'app.versement', 'app.fraterie', 'app.paiement_type', 'app.paiement', 'app.adultes_unite', 'app.information_scolaire', 'app.prescription', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale');

	function startTest() {
		$this->FicheMedicalesMalady =& ClassRegistry::init('FicheMedicalesMalady');
	}

	function endTest() {
		unset($this->FicheMedicalesMalady);
		ClassRegistry::flush();
	}

}
