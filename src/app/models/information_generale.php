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
			)
	);
}

?>
