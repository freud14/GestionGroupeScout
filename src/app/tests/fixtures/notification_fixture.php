<?php
/* Notification Fixture generated on: 2011-11-21 11:36:31 : 1321893391 */
class NotificationFixture extends CakeTestFixture {
	var $name = 'Notification';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'type_sujet_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'detail' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'latin1_general_ci', 'charset' => 'latin1'),
		'date' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'id_sujet' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_notifications_type_sujets' => array('column' => 'type_sujet_id', 'unique' => 0), 'fk_notifications_fiche_medicales' => array('column' => 'id_sujet', 'unique' => 0), 'fk_notification_type_enfants' => array('column' => 'id_sujet', 'unique' => 0), 'fk_notification_type_adultes' => array('column' => 'id_sujet', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'type_sujet_id' => 1,
			'detail' => 'Lorem ipsum dolor sit amet',
			'date' => '2011-11-21 11:36:31',
			'id_sujet' => 1
		),
	);
}
