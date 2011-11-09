<?php
class QuestionGenerale extends AppModel {
	var $name = 'QuestionGenerale';
	var $validate = array(
		'texte' => array(
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
		'FicheMedicale' => array(
			'className' => 'FicheMedicale',
			'joinTable' => 'fiche_medicales_question_generales',
			'foreignKey' => 'question_generale_id',
			'associationForeignKey' => 'fiche_medicale_id',
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
