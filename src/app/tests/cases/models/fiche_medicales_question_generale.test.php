<?php
/* FicheMedicalesQuestionGenerale Test cases generated on: 2011-11-03 16:46:37 : 1320353197*/
App::import('Model', 'FicheMedicalesQuestionGenerale');

class FicheMedicalesQuestionGeneraleTestCase extends CakeTestCase {
	var $fixtures = array('app.fiche_medicales_question_generale', 'app.fiche_medicale', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite', 'app.information_scolaire', 'app.inscription', 'app.prescription', 'app.malady', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale');

	function startTest() {
		$this->FicheMedicalesQuestionGenerale =& ClassRegistry::init('FicheMedicalesQuestionGenerale');
	}

	function endTest() {
		unset($this->FicheMedicalesQuestionGenerale);
		ClassRegistry::flush();
	}

}
