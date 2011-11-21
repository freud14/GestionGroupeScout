<?php
/* FicheMedicalesQuestionGenerale Fixture generated on: 2011-11-21 11:36:27 : 1321893387 */
class FicheMedicalesQuestionGeneraleFixture extends CakeTestFixture {
	var $name = 'FicheMedicalesQuestionGenerale';

	var $fields = array(
		'fiche_medicale_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'question_generale_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fiche_medicale_id_UNIQUE' => array('column' => array('fiche_medicale_id', 'question_generale_id'), 'unique' => 1), 'fk_fiche_medicales_question_generales_fiche_medicales' => array('column' => 'fiche_medicale_id', 'unique' => 0), 'fk_fiche_medicales_question_generales_question_generales' => array('column' => 'question_generale_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'fiche_medicale_id' => 1,
			'question_generale_id' => 1,
			'id' => 1
		),
	);
}
