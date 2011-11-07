<?php
/* GroupeAge Test cases generated on: 2011-11-03 16:46:38 : 1320353198*/
App::import('Model', 'GroupeAge');

class GroupeAgeTestCase extends CakeTestCase {
	var $fixtures = array('app.groupe_age', 'app.inscription', 'app.unite');

	function startTest() {
		$this->GroupeAge =& ClassRegistry::init('GroupeAge');
	}

	function endTest() {
		unset($this->GroupeAge);
		ClassRegistry::flush();
	}

}
