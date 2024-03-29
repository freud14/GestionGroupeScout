<?php
/*
 * Modèle pour inscrire adulte
 * @author Luc-Frédéric Langis
 */
class Profil extends AppModel {

	var $name = 'Profil';
	var $useTable = false;
	//var $uses = array('Notification'); 

	var $validate = array(
		'nom_utilisateur' => array(
			'email' => array(
				'rule' => 'email',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Une adresse courriel valide sera nécessaire pour vous connecter à votre compte')
		),
		'mot_de_passe' => array(
			'regle1' => array(
				'rule' => array('compareChamps', 'mot_de_passe_confirmation'),
				'message' => 'Les mots de passe doivent être identiques'
				),
		    'regle2' => array(
				'rule' => array('minLength', 8),
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Le mot de passe doit avoir un minimum de 8 caractères.'
			)
		),
		'mot_de_passe_confirmation' => array(
			'regle1' => array(
				'rule' => array('compareChamps', 'mot_de_passe'),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Les mots de passe doivent être identiques',
				'on' => 'create')
		),
		'nom' => array(
			'regle1' => array(
				'rule' => '/.*/',
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
				'rule' => '/.*/',
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
				'rule' => array('phone', null, 'us'),
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Rentrer un numéro de téléphone valide ex. 555-555-5555'
			)
		),
		'tel_bureau' => array(
			'regle1' => array(
				'rule' => array('phone', null, 'us'),
				'required' => false,
				'allowEmpty' => true,
				'on' => 'create',
				'message' => 'Rentrer un numéro de téléphone valide ex. 555-555-5555'
			)
		),
		'tel_autre' => array(
			'regle1' => array(
				'rule' => array('phone', null, 'us'),
				'required' => false,
				'allowEmpty' => true,
				'on' => 'create',
				'message' => 'Rentrer un numéro de téléphone valide ex. 555-555-5555'
			)
		),
		'sexe' => array(
			'regle1' => array(
				'rule' => '/[12]{1}/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Le sexe de l\'adulte doit être spécifié.'
			)
		),
	);

	function compareChamps($premier, $deuxieme) {
		$nom = '';
		foreach ($premier as $cle => $value) {
			$nom = $cle;
			break;
		}
		return $this->data[$this->name][$deuxieme] === $this->data[$this->name][$nom];
	}

}

?>
