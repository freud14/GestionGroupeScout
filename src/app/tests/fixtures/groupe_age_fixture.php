<?php
/* GroupeAge Fixture generated on: 2011-11-08 18:38:22 : 1320795502 */
class GroupeAgeFixture extends CakeTestFixture {
	var $name = 'GroupeAge';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'nom' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'age_min' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'age_max' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'sexe' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'nom' => 'Lorem ipsum dolor sit amet',
			'age_min' => 1,
			'age_max' => 1,
			'sexe' => 1
		),
	);
}
