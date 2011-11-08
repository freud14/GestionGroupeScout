<?php
/* ContactUrgence Fixture generated on: 2011-11-08 14:01:30 : 1320778890 */
class ContactUrgenceFixture extends CakeTestFixture {
	var $name = 'ContactUrgence';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'adulte_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'enfant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'lien' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_contact_urgences_enfants' => array('column' => 'enfant_id', 'unique' => 0), 'fk_contact_urgences_adultes' => array('column' => 'adulte_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'adulte_id' => 1,
			'enfant_id' => 1,
			'lien' => 'Lorem ipsum dolor sit amet'
		),
	);
}
