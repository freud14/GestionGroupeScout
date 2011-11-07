<?php
/* Adress Fixture generated on: 2011-11-03 16:46:29 : 1320353189 */
class AdressFixture extends CakeTestFixture {
	var $name = 'Adress';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'adresses' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'ville' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'code_postal' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 6, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'adresses' => 'Lorem ipsum dolor sit amet',
			'ville' => 'Lorem ipsum dolor sit amet',
			'code_postal' => 'Lore'
		),
	);
}
