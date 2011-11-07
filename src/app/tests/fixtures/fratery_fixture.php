<?php
/* Fratery Fixture generated on: 2011-11-03 16:46:37 : 1320353197 */
class FrateryFixture extends CakeTestFixture {
	var $name = 'Fratery';

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
