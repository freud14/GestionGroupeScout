<?php
/* AdultesEnfant Fixture generated on: 2011-11-21 11:36:20 : 1321893380 */
class AdultesEnfantFixture extends CakeTestFixture {
	var $name = 'AdultesEnfant';

	var $fields = array(
		'adulte_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'enfant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'adulte_id_UNIQUE' => array('column' => array('adulte_id', 'enfant_id'), 'unique' => 1), 'fk_adultes_enfants_adultes' => array('column' => 'adulte_id', 'unique' => 0), 'fk_adultes_enfants_enfants' => array('column' => 'enfant_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'adulte_id' => 1,
			'enfant_id' => 1,
			'id' => 1
		),
	);
}
