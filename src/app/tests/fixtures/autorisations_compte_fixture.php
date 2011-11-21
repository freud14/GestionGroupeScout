<?php
/* AutorisationsCompte Fixture generated on: 2011-11-21 11:36:22 : 1321893382 */
class AutorisationsCompteFixture extends CakeTestFixture {
	var $name = 'AutorisationsCompte';

	var $fields = array(
		'autorisation_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'compte_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'autorisation_id_UNIQUE' => array('column' => array('autorisation_id', 'compte_id'), 'unique' => 1), 'FK_id_comptes' => array('column' => 'compte_id', 'unique' => 0), 'FK_id_autorisations' => array('column' => 'autorisation_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'autorisation_id' => 1,
			'compte_id' => 1,
			'id' => 1
		),
	);
}
