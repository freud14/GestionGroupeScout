<?php
class InscriptionAutorisationController extends AppController {
	var $name = 'InscriptionAutorisation';
	var $helpers = array("Html",'Form');
	
	function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'parent';
			$this->loadModel('Compte');
			$this->loadModel('Adulte');
			$this->loadModel('AdultesImplication');
			$this->loadModel('Implication');
	}

	
	
	
	
	function navigation(){
		$this -> Session -> write("url", $this->params['url']);
		if(array_key_exists ('precedent',$this->params['form']))
 		{
			$this->redirect(array('controller'=>'inscription_fiche_med', 'action'=>'index'));
			
		}elseif( array_key_exists ('accepter',$this->params['form']))
 		{
 		//si le bouton suivant est cliqué
 			pr($this->params['data']);
 			$this -> Session -> write("session", $this->params['data']);
 			$this->redirect(array('controller'=>'inscription_confirmation', 'action'=>'index'));
		}
	
	}
	function index(){
		
			$this->navigation();
		
			$this->set('title_for_layout', __('Autorisations', true));
			$this->set('titre',__('Autorisations',true));
			$this->set('ariane', __('Informations générales > Fiches médicales > <span style="color: green;">Autorisations</span>', true));
	}
	
		
}
?>
