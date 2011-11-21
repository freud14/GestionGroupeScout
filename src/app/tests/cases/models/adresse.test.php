<?php
/* Adresse Test cases generated on: 2011-11-21 11:36:19 : 1321893379*/
App::import('Model', 'Adresse');

class AdresseTestCase extends CakeTestCase {
	var $fixtures = array('app.adresse', 'app.enfant', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.type_sujet', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.groupe_age', 'app.inscription', 'app.annee', 'app.facture', 'app.nb_versement', 'app.versement', 'app.fraterie', 'app.paiement_type', 'app.paiement', 'app.adultes_unite', 'app.fiche_medicale', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale', 'app.information_scolaire');

	function startTest() {
		$this->Adresse =& ClassRegistry::init('Adresse');
	}

	function endTest() {
		unset($this->Adresse);
		ClassRegistry::flush();
	}

}
