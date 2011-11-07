<?php
/* InformationScolaire Test cases generated on: 2011-11-03 16:46:39 : 1320353199*/
App::import('Model', 'InformationScolaire');

class InformationScolaireTestCase extends CakeTestCase {
	var $fixtures = array('app.information_scolaire', 'app.enfant', 'app.adresse', 'app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.comptes_notification', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite', 'app.fiche_medicale', 'app.prescription', 'app.malady', 'app.fiche_medicales_malady', 'app.medicament', 'app.fiche_medicales_medicament', 'app.question_generale', 'app.fiche_medicales_question_generale', 'app.inscription');

	function startTest() {
		$this->InformationScolaire =& ClassRegistry::init('InformationScolaire');
	}

	function endTest() {
		unset($this->InformationScolaire);
		ClassRegistry::flush();
	}

}
