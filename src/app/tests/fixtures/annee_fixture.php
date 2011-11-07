<?php
/* Annee Fixture generated on: 2011-11-03 16:46:31 : 1320353191 */
class AnneeFixture extends CakeTestFixture {
	var $name = 'Annee';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'date_debut' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'date_fin' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'inscription' => array('type' => 'binary', 'null' => false, 'default' => NULL, 'length' => 1),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'date_debut' => '2011-11-03 16:46:31',
			'date_fin' => '2011-11-03 16:46:31',
			'inscription' => 'Lorem ipsum dolor sit ame'
		),
	);
}
