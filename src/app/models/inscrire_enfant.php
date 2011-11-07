<?php
class InscrireEnfant extends AppModel {
	var $name = 'InscrireEnfant';
	var $useTable = false;
	
	var $validate = array(
		'nom' => array(
			'rule' => array('minLength', 3), // ou bien : array('nomRegle', 'parametre1', 'parametre2' ...)
			'required' => true,
			'allowEmpty' => false,
			'on' => 'create', // ou bien : 'update'
			'message' => ''
		)
	);

}

?>
