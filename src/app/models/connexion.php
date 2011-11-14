<?php
class Connexion extends AppModel {
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
            ),			
			 'regle' => array(
                'rule' => '/.*/',
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
	/*			'mauvaisMDP' => array(
            		    'rule' => array('mauvaisMDP', 'nom_utilisateur', 'mot_de_passe'),
						'required' => true,
						'allowEmpty' => false,
                		'message' => 'Le mot de passe est incorrect'
            )*/


		)
	);


	/*function mauvaisMDP($nom, $mdp) {

		
			if((Classregistry::init('Compte')->find('all', array('conditions' => array('Compte.nom_utilisateur' => $nom, 'Compte.mot_de_passe' => $mdp))))){

					return FALSE;

		    } elseif((Classregistry::init('Compte')->find('all', array('conditions' => array('Compte.nom_utilisateur' => $nom))))){

					return TRUE;
			}
				
				return FALSE;
	}*/
}

 ?>
