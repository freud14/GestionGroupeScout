<?php
class Annee extends AppModel {
	var $name = 'Annee';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Inscription' => array(
			'className' => 'Inscription',
			'foreignKey' => 'annee_id',
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

}
