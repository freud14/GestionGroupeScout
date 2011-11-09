<?php
/* Unite Fixture generated on: 2011-11-08 18:38:30 : 1320795510 */
class UniteFixture extends CakeTestFixture {
	var $name = 'Unite';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'groupe_age_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'nom' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_unite_groupe_age' => array('column' => 'groupe_age_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'groupe_age_id' => 1,
			'nom' => 'Lorem ipsum dolor sit amet'
		),
	);
}
