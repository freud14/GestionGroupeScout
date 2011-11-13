<?php
class InscrireAdulte extends AppModel {
	var $name = 'InscrireAdulte';
	var $useTable = false;
	//var $uses = array('Notification'); 
	
	var $validate = array(
	
		'nom_utilisateur' => array(
            'email' => array(
                'rule' => 'email',
				'required' => true,
				'allowEmpty' => false,
                'message' => 'Une adresse email valide sera nécessaire pour vous connecter à votre compte'
            )			
		),
		'nom' => array(
				'regle1' => array(
						'rule' => array('required', true),
						'required' => true,
						'allowEmpty' => false,
						'on' => 'create',
						'message' => 'Le champ ne peut être vide.'
						),
						
				'regle2' => array(
						'rule' => array('maxLength', 45),
						'message' => 'Le champ doit contenir moins de 45 caractères.'
						)

			),
		'prenom' => array(
				'regle1' => array(
						'rule' => array('required', true),
						'required' => true,
						'allowEmpty' => false,
						'on' => 'create',
						'message' => 'Le champ ne peut être vide.'
						),
				'regle2' => array(
						'rule' => array('maxLength', 45),
						'message' => 'Le champ doit contenir moins de 45 caractères.'
						)

			),
		'tel_maison' => array(
				'regle1' => array(
						'rule' => array('phone', null, 'ca'),
						'required' => true,
						'allowEmpty' => false,
						'on' => 'create',
						'message' => 'Rentrer un numéro de téléphone valide'
						)
			)

	);
	
}

?>
