<?php
/* ComptesNotification Fixture generated on: 2011-11-08 18:38:17 : 1320795497 */
class ComptesNotificationFixture extends CakeTestFixture {
	var $name = 'ComptesNotification';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'compte_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'notification_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'etat' => array('type' => 'binary', 'null' => false, 'default' => NULL, 'length' => 1),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'comptes_id_UNIQUE' => array('column' => array('compte_id', 'notification_id'), 'unique' => 1), 'fk_comptes_notifications_comptes' => array('column' => 'compte_id', 'unique' => 0), 'fk_comptes_notifications_notifications' => array('column' => 'notification_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'compte_id' => 1,
			'notification_id' => 1,
			'etat' => 'Lorem ipsum dolor sit ame'
		),
	);
}
