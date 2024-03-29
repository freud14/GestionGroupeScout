<?php
/* Compte Fixture generated on: 2011-11-21 11:36:23 : 1321893383 */
class CompteFixture extends CakeTestFixture {
	var $name = 'Compte';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'nom_utilisateur' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'key' => 'unique', 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'mot_de_passe' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'nom_utilisateur_UNIQUE' => array('column' => 'nom_utilisateur', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'nom_utilisateur' => 'Lorem ipsum dolor sit amet',
			'mot_de_passe' => 'Lorem ipsum dolor sit amet'
		),
	);
}
