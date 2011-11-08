<?php
/* ComptesNotification Test cases generated on: 2011-11-08 14:01:29 : 1320778889*/
App::import('Model', 'ComptesNotification');

class ComptesNotificationTestCase extends CakeTestCase {
	var $fixtures = array('app.comptes_notification', 'app.compte', 'app.adulte', 'app.contact_urgence', 'app.enfant', 'app.adultes_enfant', 'app.implication', 'app.adultes_implication', 'app.unite', 'app.adultes_unite', 'app.autorisation', 'app.autorisations_compte', 'app.notification');

	function startTest() {
		$this->ComptesNotification =& ClassRegistry::init('ComptesNotification');
	}

	function endTest() {
		unset($this->ComptesNotification);
		ClassRegistry::flush();
	}

}
