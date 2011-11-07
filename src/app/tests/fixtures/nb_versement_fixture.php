<?php
/* NbVersement Fixture generated on: 2011-11-03 16:46:41 : 1320353201 */
class NbVersementFixture extends CakeTestFixture {
	var $name = 'NbVersement';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'nb_versements' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'nb_versements_UNIQUE' => array('column' => 'nb_versements', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'nb_versements' => 1
		),
	);
}
