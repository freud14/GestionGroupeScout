<?php
/* TypeSujet Test cases generated on: 2011-11-21 11:36:35 : 1321893395*/
App::import('Model', 'TypeSujet');

class TypeSujetTestCase extends CakeTestCase {
	var $fixtures = array('app.type_sujet', 'app.notification', 'app.compte', 'app.adulte', 'app.contact_urgence', 'app.enfant', 'app.adresse', 'app.fiche_medicale', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale', 'app.information_scolaire', 'app.inscription', 'app.groupe_age', 'app.unite', 'app.adultes_unite', 'app.annee', 'app.facture', 'app.nb_versement', 'app.versement', 'app.fraterie', 'app.paiement_type', 'app.paiement', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.autorisation', 'app.autorisations_compte', 'app.comptes_notification');

	function startTest() {
		$this->TypeSujet =& ClassRegistry::init('TypeSujet');
	}

	function endTest() {
		unset($this->TypeSujet);
		ClassRegistry::flush();
	}

}
