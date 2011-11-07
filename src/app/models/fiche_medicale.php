<?php
class FicheMedicale extends AppModel {
	var $name = 'FicheMedicale';
	var $validate = array(
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
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Enfant' => array(
			'className' => 'Enfant',
			'foreignKey' => 'enfant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Prescription' => array(
			'className' => 'Prescription',
			'foreignKey' => 'fiche_medicale_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


	var $hasAndBelongsToMany = array(
		'Malady' => array(
			'className' => 'Malady',
			'joinTable' => 'fiche_medicales_maladies',
			'foreignKey' => 'fiche_medicale_id',
			'associationForeignKey' => 'malady_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Medicament' => array(
			'className' => 'Medicament',
			'joinTable' => 'fiche_medicales_medicaments',
			'foreignKey' => 'fiche_medicale_id',
			'associationForeignKey' => 'medicament_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'QuestionGenerale' => array(
			'className' => 'QuestionGenerale',
			'joinTable' => 'fiche_medicales_question_generales',
			'foreignKey' => 'fiche_medicale_id',
			'associationForeignKey' => 'question_generale_id',
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
