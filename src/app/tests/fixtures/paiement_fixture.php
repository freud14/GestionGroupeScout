<?php
/* Paiement Fixture generated on: 2011-11-21 11:36:32 : 1321893392 */
class PaiementFixture extends CakeTestFixture {
	var $name = 'Paiement';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'date_paiements' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'montant' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'facture_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'paiement_type_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'date_reception' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_paiements_paiement_types' => array('column' => 'paiement_type_id', 'unique' => 0), 'fk_paiements_factures' => array('column' => 'facture_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'date_paiements' => '2011-11-21 11:36:32',
			'montant' => 1,
			'facture_id' => 1,
			'paiement_type_id' => 1,
			'date_reception' => '2011-11-21 11:36:32'
		),
	);
}
