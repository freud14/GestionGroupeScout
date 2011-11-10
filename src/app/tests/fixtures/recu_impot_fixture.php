<?php
/* RecuImpot Fixture generated on: 2011-11-08 18:38:29 : 1320795509 */
class RecuImpotFixture extends CakeTestFixture {
	var $name = 'RecuImpot';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'date_emission' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'no_recu' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'factures_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_recu_impots_factures' => array('column' => 'factures_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'date_emission' => '2011-11-08 18:38:29',
			'no_recu' => 'Lorem ipsum dolor sit amet',
			'factures_id' => 1
		),
	);
}
