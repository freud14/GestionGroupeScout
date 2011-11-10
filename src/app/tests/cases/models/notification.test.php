<?php
/* Notification Test cases generated on: 2011-11-08 18:38:26 : 1320795506*/
App::import('Model', 'Notification');

class NotificationTestCase extends CakeTestCase {
	var $fixtures = array('app.notification', 'app.type_sujet', 'app.compte', 'app.adulte', 'app.contact_urgence', 'app.enfant', 'app.adresse', 'app.fiche_medicale', 'app.prescription', 'app.maladie', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale', 'app.information_scolaire', 'app.inscription', 'app.groupe_age', 'app.unite', 'app.annee', 'app.facture', 'app.nb_versement', 'app.versement', 'app.fraterie', 'app.paiement', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.adultes_unite', 'app.autorisation', 'app.autorisations_compte', 'app.comptes_notification');

	function startTest() {
		$this->Notification =& ClassRegistry::init('Notification');
	}

	function endTest() {
		unset($this->Notification);
		ClassRegistry::flush();
	}

}
