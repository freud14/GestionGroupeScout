<?php

class InformationPaiementComponent extends Object {
	
	var $InformationPaiement;
	
	function __construct() {
		parent::__construct();
		 $this->$InformationPaiement = ClassRegistry::init('$InformationPaiement');
	}
	
	function créerPaiement($inscriptions_id, $mode_paiement) {
		$inscriptions_id = (array)$inscriptions_id;
		//$this->InformationPaiement->
	}
}
?>

