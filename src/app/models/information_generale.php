<?php
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
		/*'date_de_naissance' => array(
				'regle1' => array(
						'rule' => array('verifierDate'),
						'message' => 'La date de naissance semble être une date invalide.'
						)
			)*/
		);
	
	function verifierDate($field) {
		return checkdate(intval($field['date_de_naissance']['month']), intval($field['date_de_naissance']['day']), intval($field['date_de_naissance']['year']));
	}
}

?>
