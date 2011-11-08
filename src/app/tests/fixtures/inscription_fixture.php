<?php
/* Inscription Fixture generated on: 2011-11-08 14:01:36 : 1320778896 */
class InscriptionFixture extends CakeTestFixture {
	var $name = 'Inscription';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'enfant_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'groupe_age_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'date_inscription' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'annee_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'autorisation_photo' => array('type' => 'binary', 'null' => false, 'default' => NULL, 'length' => 1),
		'autorisation_baignade' => array('type' => 'binary', 'null' => false, 'default' => NULL, 'length' => 1),
		'unite_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'date_fin' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_inscriptions_groupes_ages' => array('column' => 'groupe_age_id', 'unique' => 0), 'fk_inscriptions_annees' => array('column' => 'annee_id', 'unique' => 0), 'fk_inscriptions_enfants' => array('column' => 'enfant_id', 'unique' => 0), 'fk_inscriptions_unites' => array('column' => 'unite_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'enfant_id' => 1,
			'groupe_age_id' => 1,
			'date_inscription' => '2011-11-08 14:01:36',
			'annee_id' => 1,
			'autorisation_photo' => 'Lorem ipsum dolor sit ame',
			'autorisation_baignade' => 'Lorem ipsum dolor sit ame',
			'unite_id' => 1,
			'date_fin' => '2011-11-08 14:01:36'
		),
	);
}
