<?php
/* Adulte Fixture generated on: 2011-11-08 14:01:25 : 1320778885 */
class AdulteFixture extends CakeTestFixture {
	var $name = 'Adulte';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'prenom' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'nom' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'tel_maison' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'sexe' => array('type' => 'binary', 'null' => true, 'default' => NULL, 'length' => 1),
		'tel_bureau' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'poste_bureau' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'tel_autre' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'profession' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'compte_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'courriel' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 256, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'FK_adultes_comptes' => array('column' => 'compte_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'prenom' => 'Lorem ipsum dolor sit amet',
			'nom' => 'Lorem ipsum dolor sit amet',
			'tel_maison' => 1,
			'sexe' => 'Lorem ipsum dolor sit ame',
			'tel_bureau' => 1,
			'poste_bureau' => 1,
			'tel_autre' => 1,
			'profession' => 'Lorem ipsum dolor sit amet',
			'compte_id' => 1,
			'courriel' => 'Lorem ipsum dolor sit amet'
		),
	);
}
