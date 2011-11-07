<?php
class FicheMedicalesMalady extends AppModel {
	var $name = 'FicheMedicalesMalady';
	var $validate = array(
		'maladie_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'fiche_medicale_id' => array(
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
		'Maladie' => array(
			'className' => 'Maladie',
			'foreignKey' => 'maladie_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FicheMedicale' => array(
			'className' => 'FicheMedicale',
			'foreignKey' => 'fiche_medicale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
