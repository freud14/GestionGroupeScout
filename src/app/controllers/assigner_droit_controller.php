<?php
//App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class AssignerDroitController extends AppController {

		 var $helpers = array('Html', 'Javascript', 'Form');  
		 var $name = 'AssignerDroit';
		// var $components = array(array('Recaptcha.Captcha' => array(
          //      'private_key' => '6Ldq4MkSAAAAACIFrlwaf209zjAOhktImcx_FjlS', 
            //    'public_key' => '6Ldq4MkSAAAAABiDfADZgxzR3Nn_wB4qppT9QBKy'))); 

		function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'parent';
			$this->loadModel("Compte");

		}

		
		/**
		 * view method
		 *
		 * @param string $id
		 * @return void
		 */
		 public function navigation() {
		
			
 			
			// $urlProvenance = $this -> Session -> read('url');
			// $this -> Session -> write("url", $this->params['url']);
			 
			if ( array_key_exists ('precedent',$this->params['form']))
 			{
 			//si le bouton précédent est cliqué
 				
 				$this->redirect(array('controller'=>'information_generale', 'action'=>'index'));
 			//pr($this->params['form']); 
 			}elseif( array_key_exists ('suivant',$this->params['form']))
 			{
 			//si le bouton suivant est cliqué	
 				$this->redirect(array('controller'=>'inscription_autorisation', 'action'=>'index'));
 			
 			}
 	
		}
		
		public function index() {
			
 		
 		
 		
		$this->set('title_for_layout', __('Gestionnaire des droits', true));
		$this->set('titre',__('Gestionnaire des droits',true));
		
		
		$resultats = $this->Compte ->find('all');
		
		$nonMembres = array();
		
		
		
		foreach($resultats as $valeur){
			if(empty($valeur['Autorisation'])){
				$nonMembres[$valeur['Compte']['id']] = array(1=>0,2=>0,3=>0,4=>0,
										'nom' => $valeur['Adulte'][0]['prenom']." ".$valeur['Adulte'][0]['nom']
										);
			}else{
				//$membres[$valeur['Compte']['id']] = $valeur['Adulte'][0]['prenom']." ".$valeur['Adulte'][0]['nom'];
				$membres[$valeur['Compte']['id']] = array(
										'nom' => $valeur['Adulte'][0]['prenom']." ".$valeur['Adulte'][0]['nom']
									 );
				
				foreach($valeur['Autorisation'] as $droit)
				{
					pr($valeur['Compte']['id']);
					pr($droit['id']);
					$membres[$valeur['Compte']['id']][] = $droit['id'];
				}
			}
			
		}
		//pr($tabDroits);
		//pr($nonMembres);
		//pr($membres);
		$this->set('nonMembre',$nonMembres);
		$this->set('membre',$membres);
		//$this->set('droit',$tabDroits);
		
		
		
		
		
		
	}
}
?>
