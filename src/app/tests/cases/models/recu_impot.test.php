<?php
/* RecuImpot Test cases generated on: 2011-11-08 18:38:29 : 1320795509*/
App::import('Model', 'RecuImpot');

class RecuImpotTestCase extends CakeTestCase {
	var $fixtures = array('app.recu_impot', 'app.factures');

	function startTest() {
		$this->RecuImpot =& ClassRegistry::init('RecuImpot');
	}

	function endTest() {
		unset($this->RecuImpot);
		ClassRegistry::flush();
	}

}
