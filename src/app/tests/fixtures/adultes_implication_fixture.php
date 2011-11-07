<?php
/* AdultesImplication Fixture generated on: 2011-11-03 16:46:30 : 1320353190 */
class AdultesImplicationFixture extends CakeTestFixture {
	var $name = 'AdultesImplication';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'implication_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'adulte_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'id_implications_UNIQUE' => array('column' => array('implication_id', 'adulte_id'), 'unique' => 1), 'fk_adultes_implications_implications' => array('column' => 'implication_id', 'unique' => 0), 'fk_adultes_implications_adultes' => array('column' => 'adulte_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'implication_id' => 1,
			'adulte_id' => 1
		),
	);
}
