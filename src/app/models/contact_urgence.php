<?php
class ContactUrgence extends AppModel {
	var $name = 'ContactUrgence';
	var $validate = array(
		'adulte_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'enfant_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lien' => array(
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

	var $belongsTo = array(
		'Adulte' => array(
			'className' => 'Adulte',
			'foreignKey' => 'adulte_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Enfant' => array(
			'className' => 'Enfant',
			'foreignKey' => 'enfant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
