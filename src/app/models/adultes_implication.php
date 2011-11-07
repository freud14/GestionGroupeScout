<?php
class AdultesImplication extends AppModel {
	var $name = 'AdultesImplication';
	var $validate = array(
		'implication_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Implication' => array(
			'className' => 'Implication',
			'foreignKey' => 'implication_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Adulte' => array(
			'className' => 'Adulte',
			'foreignKey' => 'adulte_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
