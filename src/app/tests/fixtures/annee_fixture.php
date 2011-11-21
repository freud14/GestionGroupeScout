<?php
/* Annee Fixture generated on: 2011-11-21 11:36:21 : 1321893381 */
class AnneeFixture extends CakeTestFixture {
	var $name = 'Annee';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'date_debut' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'date_fin' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'inscription' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'date_debut' => '2011-11-21 11:36:21',
			'date_fin' => '2011-11-21 11:36:21',
			'inscription' => 1
		),
	);
}
