<?php
class FicheMedicalesQuestionGenerale extends AppModel {
	var $name = 'FicheMedicalesQuestionGenerale';
	var $validate = array(
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
		'question_generale_id' => array(
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
		'FicheMedicale' => array(
			'className' => 'FicheMedicale',
			'foreignKey' => 'fiche_medicale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'QuestionGenerale' => array(
			'className' => 'QuestionGenerale',
			'foreignKey' => 'question_generale_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
