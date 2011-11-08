<?php
/* AdultesEnfant Fixture generated on: 2011-11-08 14:01:25 : 1320778885 */
class AdultesEnfantFixture extends CakeTestFixture {
	var $name = 'AdultesEnfant';

	var $fields = array(
		'adulte_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'enfant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'indexes' => array('PRIMARY' => array('column' => array('adulte_id', 'enfant_id'), 'unique' => 1), 'fk_adultes_enfants_adultes' => array('column' => 'adulte_id', 'unique' => 0), 'fk_adultes_enfants_enfants' => array('column' => 'enfant_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'adulte_id' => 1,
			'enfant_id' => 1
		),
	);
}
