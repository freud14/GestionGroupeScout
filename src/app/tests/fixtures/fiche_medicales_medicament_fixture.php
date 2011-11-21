<?php
/* FicheMedicalesMedicament Fixture generated on: 2011-11-21 11:36:26 : 1321893386 */
class FicheMedicalesMedicamentFixture extends CakeTestFixture {
	var $name = 'FicheMedicalesMedicament';

	var $fields = array(
		'medicament_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'fiche_medicale_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'medicament_id_UNIQUE' => array('column' => array('medicament_id', 'fiche_medicale_id'), 'unique' => 1), 'fk_fiche_medicales_medicaments_fiche_medicales' => array('column' => 'fiche_medicale_id', 'unique' => 0), 'fk_fiche_medicales_medicaments_medicaments' => array('column' => 'medicament_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'medicament_id' => 1,
			'fiche_medicale_id' => 1,
			'id' => 1
		),
	);
}
