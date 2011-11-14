<?php
class Compte extends AppModel {
	var $name = 'Compte';
	var $validate = array(
		'nom_utilisateur' => array(
            'email' => array(
                'rule' => 'email',
				'required' => true,
				'allowEmpty' => false,
                'message' => 'Une adresse email valide sera nécessaire pour vous connecter à votre compte'
            ),			
			 'regle' => array(
                'rule' => '/,*/',
				'required' => true,
				'allowEmpty' => false,
                'message' => 'Le champ ne peut être vide.'
            )
		),
		'mot_de_passe' => array(
				'regle' => array(
						'rule' => '/.*/',
						'required' => true,
						'allowEmpty' => false,
						'on' => 'create',
						'message' => 'Le champ ne peut être vide.'
						)
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Adulte' => array(
			'className' => 'Adulte',
			'foreignKey' => 'compte_id',
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
		'Autorisation' => array(
			'className' => 'Autorisation',
			'joinTable' => 'autorisations_comptes',
			'foreignKey' => 'compte_id',
			'associationForeignKey' => 'autorisation_id',
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
		'Notification' => array(
			'className' => 'Notification',
			'joinTable' => 'comptes_notifications',
			'foreignKey' => 'compte_id',
			'associationForeignKey' => 'notification_id',
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
