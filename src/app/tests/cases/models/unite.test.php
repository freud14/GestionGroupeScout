<?php
/* Unite Test cases generated on: 2011-11-08 18:38:30 : 1320795510*/
App::import('Model', 'Unite');

class UniteTestCase extends CakeTestCase {
	var $fixtures = array('app.unite', 'app.groupe_age', 'app.inscription', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.type_sujet', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.adultes_unite', 'app.fiche_medicale', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale', 'app.information_scolaire', 'app.annee', 'app.facture', 'app.nb_versement', 'app.versement', 'app.fraterie', 'app.paiement', 'app.paiement_type');

	function startTest() {
		$this->Unite =& ClassRegistry::init('Unite');
	}

	function endTest() {
		unset($this->Unite);
		ClassRegistry::flush();
	}

}
