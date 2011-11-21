<?php
/* Prescription Fixture generated on: 2011-11-21 11:36:33 : 1321893393 */
class PrescriptionFixture extends CakeTestFixture {
	var $name = 'Prescription';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'posologie' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'fiche_medicale_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_prescriptions_fiche_medicales' => array('column' => 'fiche_medicale_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'posologie' => 'Lorem ipsum dolor sit amet',
			'fiche_medicale_id' => 1
		),
	);
}
