<?php
class Autorisation extends AppModel {
	var $name = 'Autorisation';
	var $validate = array(
		'nom_autorisations' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Compte' => array(
			'className' => 'Compte',
			'joinTable' => 'autorisations_comptes',
			'foreignKey' => 'autorisation_id',
			'associationForeignKey' => 'compte_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
