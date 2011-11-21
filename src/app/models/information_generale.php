<?php

function p($champ) {
	//var_dump($champ);
	return $champ;
}

/**
 * Cette classe sert de modèle et valide les informations
 * générales lors de l'inscription.
 */
class InformationGenerale extends AppModel {

	/**
	 * Le nom du modèle
	 * @var string 
	 */
	var $name = 'InformationGenerale';

	/**
	 * @var bool
	 */
	var $useTable = false;

	/**
	 * Tableau de validation utilisé par CakePHP.
	 * @var array
	 */
	var $validate = array(
		'nom' => array(
			//Vérifie si le nom n'est pas vide.
			'regle1' => array(
				'rule' => '/.*/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Le champ ne peut être vide.'
			),
			//Vérifie si le champ nom ne dépasse pas 45 caractères.
			'regle2' => array(
				'rule' => array('maxLength', 45),
				'message' => 'Le champ doit contenir moins de 45 caractères.'
			)
		),
		'prenom' => array(
			//Vérifie si le prenom n'est pas vide.
			'regle1' => array(
				'rule' => '/.*/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Le champ ne peut être vide.'
			),
			//Vérifie si le champ prenom ne dépasse pas 45 caractères.
			'regle2' => array(
				'rule' => array('maxLength', 45),
				'message' => 'Le champ doit contenir moins de 45 caractères.'
			)
		),
		//Vérifie si le sexe vaut M ou F.
		'sexe' => array(
			'regle1' => array(
				'rule' => '/[12]{1}/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Le sexe de l\'enfant doit être spécifié.'
			)
		),
		//Lance la fonction de validation de la date de naissance.
		'date_de_naissance' => array(
			'regle1' => array(
				'rule' => array('verifierDate'),
				'message' => 'La date de naissance semble être une date invalide.'
			)
		),
		'assurance_maladie' => array(
			//Vérifie le format du numéro d'assurance maladie.
			'regle1' => array(
				'rule' => '/[A-Z]{4}[0-9]{8}/',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Le numéro d\'assurance maladie n\'est pas valide.'
			),
			//Lance la fonciton de validation du numéro d'assurance maladie.
			'regle2' => array(
				'rule' => array('verifierAssuranceMaladie'),
				'message' => 'Le numéro d\'assurance maladie ne concorde pas avec la date de naissance.'
			)
		),
		//Vérifie que le champ adresse n'est pas vide.
		'adresse' => array(
			'regle1' => array(
				'rule' => '/.*/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'L\'adresse doit être spécifié.'
			)
		),
		//Vérifie que le champ ville n'est pas vide.
		'ville' => array(
			'regle1' => array(
				'rule' => '/.*/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'La ville doit être spécifié.'
			)
		),
		//Vérifie le format du code postal.
		'code_postal' => array(
			'regle1' => array(
				'rule' => '/[A-Z][0-9][A-Z]\\s*[0-9][A-Z][0-9]/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Le format du code postal n\'est pas valide.'
			)
		),
		//Vérifie que le champ etab_scolaire n'est pas vide.
		'etab_scolaire' => array(
			'regle1' => array(
				'rule' => '/.*/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Un établissement scolaire doit être spécifié.'
			)
		),
		//Vérifie que le champ niveau_scolaire n'est pas vide.
		'niveau_scolaire' => array(
			'regle1' => array(
				'rule' => '/.*/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Un niveau scolaire doit être spécifié.'
			)
		),
		//Vérifie que le champ enseignant n'est pas vide.
		'enseignant' => array(
			'regle1' => array(
				'rule' => '/.*/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Un enseignant responsable doit être spécifié.'
			)
		),
		
		'nom_urgence' => array(
			//Vérifie que le champ nom_urgence n'est pas vide.
			'regle1' => array(
				'rule' => '/.*/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Le champ ne peut être vide.'
			),
			//Vérifie que le champ nom_urgence ne dépasse pas 45 caractères.
			'regle2' => array(
				'rule' => array('maxLength', 45),
				'message' => 'Le champ doit contenir moins de 45 caractères.'
			)
		),
		//Lance la fonction de validation du tuteur.
		'nom_tuteur' => array(
			'regle' => array(
				'rule' => array('verifierTuteur'),
				'message' => 'Vous devez spécifier le nom du tuteur si vous spécifiez un autre parent ou tuteur.'
			)
		),
		//Lance la fonction de validation du tuteur.
		'prenom_tuteur' => array(
			'regle' => array(
				'rule' => array('verifierTuteur'),
				'message' => 'Vous devez spécifier le prénom du tuteur si vous spécifiez un autre parent ou tuteur..'
			)
		),
		//Lance la fonction de validation du tuteur.
		'sexe_tuteur' => array(
			'regle' => array(
				'rule' => array('verifierTuteur'),
				'message' => 'Vous devez spécifier le sexe du tuteur si vous spécifiez un autre parent ou tuteur.'
			)
		),
		'prenom_urgence' => array(
			//Vérifie que le champ prenom_urgence n'est pas vide.
			'regle1' => array(
				'rule' => '/.*/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Le champ ne peut être vide.'
			),
			//Vérifie que le champ prenom_urgence ne dépasse pas 45 caractères.
			'regle2' => array(
				'rule' => array('maxLength', 45),
				'message' => 'Le champ doit contenir moins de 45 caractères.'
			)
		),
		//Vérifie que le champ telephone_principal_urgence n'est pas vide.
		'telephone_principal_urgence' => array(
			'regle1' => array(
				'rule' => '/.*/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Le champ ne peut être vide.'
			)
		),
		//Vérifie que le champ lien_jeune_urgence n'est pas vide.
		'lien_jeune_urgence' => array(
			'regle1' => array(
				'rule' => '/.*/',
				'required' => true,
				'allowEmpty' => false,
				'on' => 'create',
				'message' => 'Le champ ne peut être vide.'
			)
		),
	);

	/**
	 * Cette méthode se charge de vérifier si la date de
	 * naissance spécifiée est valide.
	 * @param type $field Tableau contenant le champ
	 * @return bool Retourne vrai si la date de
	 * naissance spécifiée est valide; faux sinon.
	 */
	function verifierDate($field) {
		return checkdate(intval($field['date_de_naissance']['month']), intval($field['date_de_naissance']['day']), intval($field['date_de_naissance']['year']));
	}

	/**
	 * Cette méthode se charge de vérifier si le 
	 * numéro d'assurance maladie est valide d'après
	 * la date de naissance. C'est une méthode de 
	 * validation appelée par CakePHP.
	 * @param type $champ Tableau contenant le champ
	 * @return bool Retourne vrai si le numéro d'assurance
	 * maladie est valide; faux sinon. 
	 */
	function verifierAssuranceMaladie($champ) {
		$naissance = $this->data['InformationGenerale'];
		$no_assurance = $champ['assurance_maladie'];
		if ($this->verifierDate($naissance)) {
			if (strlen($no_assurance) == 12) {
				$jour = $naissance['date_de_naissance']['day'];
				$mois = $naissance['date_de_naissance']['month'];
				$annee = substr($naissance['date_de_naissance']['year'], 2, 2);
				if (intval(substr($no_assurance, 4, 2)) == intval($jour) &&
						intval(substr($no_assurance, 6, 2)) == intval($mois) &&
						intval(substr($no_assurance, 8, 2)) == intval($annee)) {
					return true;
				}
			}
		} else {
			//On retourne vrai pour ne pas lancer d'erreur si la date de naissance est invalide.
			return true;
		}

		return false;
	}

	/**
	 * Cette méthode vérifie d'après le champ passé en 
	 * paramètre si les champs « nom_tuteur », « prenom_tuteur »
	 * ou « sexe_tuteur » doivent levées une erreur. C'est
	 * une méthode de validation appelée par CakePHP.
	 * @param type $field Tableau contenant le champ
	 * @return bool Retourne vrai si la valeur du champ est
	 * valide; faux sinon. 
	 */
	function verifierTuteur($field) {
		$listeChamp = array('nom_tuteur',
			'prenom_tuteur',
			'sexe_tuteur',
			'courriel_tuteur',
			'telephone_maison_tuteur',
			'telephone_bureau_tuteur',
			'telephone_bureau_poste_tuteur',
			'cellulaire_tuteur',
			'emploi_tuteur');
		$s = array_keys($field);
		$s = $s[0];
		unset($listeChamp[$s]);
		if (!empty($field[$s])) {
			return true;
		} else {
			//pr($this->data);
			foreach ($listeChamp as $champ) {
				if (!empty($this->data['InformationGenerale'][$champ])) {
					return false;
				}
			}
		}

		return true;
	}

}

?>
