<?php
/* Versement Fixture generated on: 2011-11-21 11:36:36 : 1321893396 */
class VersementFixture extends CakeTestFixture {
	var $name = 'Versement';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'fraterie_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'montant' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'position' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'nb_versement_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_versements_nb_versements' => array('column' => 'nb_versement_id', 'unique' => 0), 'fk_versements_frateries' => array('column' => 'fraterie_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'fraterie_id' => 1,
			'montant' => 1,
			'date' => '2011-11-21 11:36:36',
			'position' => 1,
			'nb_versement_id' => 1
		),
	);
}
