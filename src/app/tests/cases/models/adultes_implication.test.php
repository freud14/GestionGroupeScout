<?php
/* AdultesImplication Test cases generated on: 2011-11-03 16:46:30 : 1320353190*/
App::import('Model', 'AdultesImplication');

class AdultesImplicationTestCase extends CakeTestCase {
	var $fixtures = array('app.adultes_implication', 'app.implication', 'app.adulte', 'app.compte', 'app.contact_urgence', 'app.enfant', 'app.adultes_enfant', 'app.unite', 'app.adultes_unite');

	function startTest() {
		$this->AdultesImplication =& ClassRegistry::init('AdultesImplication');
	}

	function endTest() {
		unset($this->AdultesImplication);
		ClassRegistry::flush();
	}

}
