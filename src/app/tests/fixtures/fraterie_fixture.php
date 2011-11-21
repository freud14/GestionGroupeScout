<?php
/* Fraterie Fixture generated on: 2011-11-21 11:36:27 : 1321893387 */
class FraterieFixture extends CakeTestFixture {
	var $name = 'Fraterie';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'position' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'position_UNIQUE' => array('column' => 'position', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'position' => 1
		),
	);
}
