<?php
/* FicheMedicale Fixture generated on: 2011-11-21 11:36:25 : 1321893385 */
class FicheMedicaleFixture extends CakeTestFixture {
	var $name = 'FicheMedicale';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'enfant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'allergie' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'phobie' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'U_enfant' => array('column' => 'enfant_id', 'unique' => 1), 'fk_fiche_medicales_enfants' => array('column' => 'enfant_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'enfant_id' => 1,
			'allergie' => 'Lorem ipsum dolor sit amet',
			'phobie' => 'Lorem ipsum dolor sit amet'
		),
	);
}
