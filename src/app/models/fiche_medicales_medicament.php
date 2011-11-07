<?php
class FicheMedicalesMedicament extends AppModel {
	var $name = 'FicheMedicalesMedicament';
	var $validate = array(
		'medicament_id' => array(
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
		'Medicament' => array(
			'className' => 'Medicament',
			'foreignKey' => 'medicament_id',
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
