<?php
/* Enfant Fixture generated on: 2011-11-21 11:36:24 : 1321893384 */
class EnfantFixture extends CakeTestFixture {
	var $name = 'Enfant';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'nom' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'prenom' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'date_naissance' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'adresse_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'no_ass_maladie' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 12, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'sexe' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'particularite_jeunes' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_enfants_adresses' => array('column' => 'adresse_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'nom' => 'Lorem ipsum dolor sit amet',
			'prenom' => 'Lorem ipsum dolor sit amet',
			'date_naissance' => '2011-11-21',
			'adresse_id' => 1,
			'no_ass_maladie' => 'Lorem ipsu',
			'sexe' => 1,
			'particularite_jeunes' => 'Lorem ipsum dolor sit amet'
		),
	);
}
