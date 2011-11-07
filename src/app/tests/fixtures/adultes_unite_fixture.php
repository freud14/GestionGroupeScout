<?php
/* AdultesUnite Fixture generated on: 2011-11-03 16:46:30 : 1320353190 */
class AdultesUniteFixture extends CakeTestFixture {
	var $name = 'AdultesUnite';

	var $fields = array(
		'adulte_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'unite_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'indexes' => array('PRIMARY' => array('column' => array('adulte_id', 'unite_id'), 'unique' => 1), 'fk_adultes_unites_adultes' => array('column' => 'adulte_id', 'unique' => 0), 'fk_adultes_unites' => array('column' => 'unite_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'adulte_id' => 1,
			'unite_id' => 1
		),
	);
}
