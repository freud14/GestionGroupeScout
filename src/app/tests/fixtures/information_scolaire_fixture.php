<?php
/* InformationScolaire Fixture generated on: 2011-11-08 18:38:23 : 1320795503 */
class InformationScolaireFixture extends CakeTestFixture {
	var $name = 'InformationScolaire';

	var $fields = array(
		'enfant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'nom_ecole' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'niveau_scolaire' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'nom_enseignant' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'enfant_id', 'unique' => 1), 'fk_information_scolaires_enfants' => array('column' => 'enfant_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'enfant_id' => 1,
			'nom_ecole' => 'Lorem ipsum dolor sit amet',
			'niveau_scolaire' => 'Lorem ipsum dolor sit amet',
			'nom_enseignant' => 'Lorem ipsum dolor sit amet'
		),
	);
}
