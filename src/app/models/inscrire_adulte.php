<?php
class InscrireAdulte extends AppModel {
	var $name = 'InscrireAdulte';
	var $useTable = false;
	//var $uses = array('Notification'); 
	
	var $validate = array(
	
		'nom_utilisateur' => array(
            'email' => array(
                'rule' => 'email',
                'message' => 'Une adresse email valide sera nécessaire pour vous connecter à votre compte'
            )			
		),
		
		'mot_de_passe' => array(
            'email' => array(
                'rule' => 'email',
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
			)
	);
	
	
	function identicalFieldValues( $field=array(), $compare_field=null ) 
	{
		foreach( $field as $key => $value ){
			$v1 = $value;
			$v2 = $this->data[$this->name][ $compare_field ];                 
				
				if($v1 !== $v2) {
					return FALSE;
				} else {
					continue;
				}
				}
			return TRUE;
	}

}

?>
