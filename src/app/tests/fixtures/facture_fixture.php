<?php
/* Facture Fixture generated on: 2011-11-21 11:36:25 : 1321893385 */
class FactureFixture extends CakeTestFixture {
	var $name = 'Facture';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'no_facture' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'date_facturation' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'inscription_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'nb_versement_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'fraterie_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_factures_nb_versements' => array('column' => 'nb_versement_id', 'unique' => 0), 'fk_factures_frateries' => array('column' => 'fraterie_id', 'unique' => 0), 'fk_factures_inscriptions' => array('column' => 'inscription_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'no_facture' => 'Lorem ipsum dolor sit amet',
			'date_facturation' => '2011-11-21 11:36:25',
			'inscription_id' => 1,
			'nb_versement_id' => 1,
			'fraterie_id' => 1
		),
	);
}
