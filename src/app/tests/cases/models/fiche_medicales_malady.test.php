<?php
/* FicheMedicalesMalady Test cases generated on: 2011-11-08 18:38:19 : 1320795499*/
App::import('Model', 'FicheMedicalesMalady');

class FicheMedicalesMaladyTestCase extends CakeTestCase {
	var $fixtures = array('app.fiche_medicales_malady', 'app.maladie', 'app.fiche_medicale', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite', 'app.information_scolaire', 'app.inscription', 'app.prescription', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale');

	function startTest() {
		$this->FicheMedicalesMalady =& ClassRegistry::init('FicheMedicalesMalady');
	}

	function endTest() {
		unset($this->FicheMedicalesMalady);
		ClassRegistry::flush();
	}

}
