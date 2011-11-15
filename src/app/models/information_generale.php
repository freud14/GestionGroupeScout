<?php
function p($champ) {
	//var_dump($champ);
	return $champ;
}

class InformationGenerale extends AppModel {
	var $name = 'InformationGenerale';
	var $useTable = false;
	
	var $validate = array(
		'nom' => array(
				'regle1' => array(
						'rule' => '/.*/', //array('required', true),
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
		'sexe' => array(
				'regle1' => array(
						'rule' => '/[MF]{1}/',
						'required' => true,
						'allowEmpty' => false,
						'on' => 'create',
						'message' => 'Le sexe de l\'enfant doit être spécifié.'
						)
			),
		'date_de_naissance' => array(
				'regle1' => array(
						'rule' => array('verifierDate'),
						'message' => 'La date de naissance semble être une date invalide.'
						)
			),
		'assurance_maladie' => array(
				'regle1' => array(
						'rule' => '/[A-Z]{4}[0-9]{8}/',
						'required' => true,
						'allowEmpty' => false,
						'message' => 'Le numéro d\'assurance maladie n\'est pas valide.'
						),
				'regle2' => array(
						'rule' => array('verifierAssuranceMaladie', 'prenom'),
						'message' => 'Le numéro d\'assurance maladie ne concorde pas avec la date de naissance.'
						)
			),
		'adresse' => array(
				'regle1' => array(
						'rule' => '/.*/',
						'required' => true,
						'allowEmpty' => false,
						'on' => 'create',
						'message' => 'L\'adresse doit être spécifié.'
						)
			),
		'ville' => array(
				'regle1' => array(
						'rule' => '/.*/',
						'required' => true,
						'allowEmpty' => false,
						'on' => 'create',
						'message' => 'La ville doit être spécifié.'
						)
			),
		'code_postal' => array(
				'regle1' => array(
						'rule' => '/[A-Z][0-9][A-Z]\\s*[0-9][A-Z][0-9]/',
						'required' => true,
						'allowEmpty' => false,
						'on' => 'create',
						'message' => 'Le format du code postal n\'est pas valide.'
						)
			),
		'etab_scolaire' => array(
				'regle1' => array(
						'rule' => '/.*/',
						'required' => true,
						'allowEmpty' => false,
						'on' => 'create',
						'message' => 'Un établissement scolaire doit être spécifié.'
						)
			),
		'niveau_scolaire' => array(
				'regle1' => array(
						'rule' => '/.*/',
						'required' => true,
						'allowEmpty' => false,
						'on' => 'create',
						'message' => 'Un niveau scolaire doit être spécifié.'
						)
			),
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
		'nom_tuteur' => array(
				'regle' => array(
						'rule' => array('verifierTuteur'),
						'message' => 'Blalbla.'
						)
			),
		'prenom_tuteur' => array(
				'regle' => array(
						'rule' => array('verifierTuteur'),
						'message' => 'Blalbla.'
						)
			),
		'sexe_tuteur' => array(
				'regle' => array(
						'rule' => array('verifierTuteur'),
						'message' => 'Blalbla.'
						)
			),
		'prenom_urgence' => array(
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
		'telephone_principal_urgence' => array(
				'regle1' => array(
						'rule' => '/.*/',
						'required' => true,
						'allowEmpty' => false,
						'on' => 'create',
						'message' => 'Le champ ne peut être vide.'
						)
			),
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
	
	function verifierDate($field) {
		return checkdate(intval($field['date_de_naissance']['month']), intval($field['date_de_naissance']['day']), intval($field['date_de_naissance']['year']));
	}
	
	function verifierAssuranceMaladie($champ) {
		$naissance = $this->data['InformationGenerale'];
		$no_assurance = $champ['assurance_maladie'];
		if($this->verifierDate($naissance)) {
			if(strlen($no_assurance) == 12) {
				$jour = $naissance['date_de_naissance']['day'];
				$mois = $naissance['date_de_naissance']['month'];
				$annee = substr($naissance['date_de_naissance']['year'], 2, 2);
				if(intval(substr($no_assurance, 4, 2)) == intval($jour) &&
				   intval(substr($no_assurance, 6, 2)) == intval($mois) &&
				   intval(substr($no_assurance, 8, 2)) == intval($annee)) {
					return true;
				}
			}
		}
		else {
			//On retourne vrai pour ne pas lancer d'erreur si la date de naissance est invalide.
			return true;
		}
		
		return false;
	}
	
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
		if(!empty($field[$s])) {
			return true;
		}
		else {
			//pr($this->data);
			foreach($listeChamp as $champ) {
				if(!empty($this->data['InformationGenerale'][$champ])) {
					return false;
				}
			}
		}
		
		return true;
	}
}

?>
