<?php
/* ContactUrgence Test cases generated on: 2011-11-08 14:01:30 : 1320778890*/
App::import('Model', 'ContactUrgence');

class ContactUrgenceTestCase extends CakeTestCase {
	var $fixtures = array('app.contact_urgence', 'app.adulte', 'app.compte', 'app.autorisation', 'app.autorisations_compte', 'app.notification', 'app.comptes_notification', 'app.enfant', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite');

	function startTest() {
		$this->ContactUrgence =& ClassRegistry::init('ContactUrgence');
	}

	function endTest() {
		unset($this->ContactUrgence);
		ClassRegistry::flush();
	}

}
