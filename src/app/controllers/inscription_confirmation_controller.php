<?php
class InscriptionConfirmationController extends AppController {
      
	var $name = 'InscriptionConfirmation';
	var $helpers = array("Html",'Form');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		setlocale(LC_ALL, 'fr_CA.utf8');
	}
	
	function navigation(){
	$this -> Session -> write("url", $this->params['url']);
	if ( array_key_exists ('paiement',$this->params['form']))
 	{
 		//si le bouton accepter est cliqué
 		
 		$this -> Session -> write("session", $this->params['data']);
 		
 		$this->redirect(array('controller'=>'gestionnaire_paiement', 'action'=>'index'));
 	}elseif ( array_key_exists ('inscription',$this->params['form']))
 	{
 		//si le bouton précédent est cliqué
 		
 		//$this -> Session -> write("session", $this->params['data']);
 		$this->redirect(array('controller'=>'information_generale', 'action'=>'index'));
 		$this->redirect('../information_generale');
 		}
	}
	function index()
	{
		$this->navigation();
		$this->set('title_for_layout', __('Inscription d\'un enfant réussie', true));
		$this->set('titre',__('Fin de l\'inscrtiption',true));
		
	}
	

	
}
?>
