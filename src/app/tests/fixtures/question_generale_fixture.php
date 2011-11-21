<?php
/* QuestionGenerale Fixture generated on: 2011-11-21 11:36:33 : 1321893393 */
class QuestionGeneraleFixture extends CakeTestFixture {
	var $name = 'QuestionGenerale';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'texte' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'texte' => 'Lorem ipsum dolor sit amet'
		),
	);
}
