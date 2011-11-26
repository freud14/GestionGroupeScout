<?php

class ConnexionController extends AppController {

		 var $helpers = array('Html', 'Form');  
		 var $name = 'Connexion';
		 var $components = array('validerInformation');

		function beforeFilter(){
			
			parent::beforeFilter();
			$this->layout = 'non_connecte';
			$this->loadModel('Compte'); 
		}
		/*
		*La fonction _navigation vérifie quel bouton a été cliqué et execute la bonne action
		*/
		 private function _navigation() {
		
			//si le bouton connexion est cliqué
			if ( array_key_exists ('connexion',$this->params['form']))
 			{
 				$resultat = $this->validerInformation->validerInformation($this->data['Connexion']['nom_utilisateur'],$this->data['Connexion']['mot_de_passe']);		
				
				//si le mot de passe est valide
				if(!empty($resultat))
				{
					$this -> Session -> write("authentification", $resultat);
					$this->redirect(array('controller'=>'information_generale', 'action'=>'index'));
				//si le mot de passe n'est pas valide	
				}else{
					$this -> Session -> write("authentification", null);
					pr("looser");
				}
 			}elseif ( array_key_exists ('inscrire',$this->params['form']))
 			{
                                $this->redirect(array('controller'=>'inscrire_adulte', 'action'=>'index'));
                                
                        }
		}

		/**
		 *
		 */
		 public function index() {
			$this->set('titre',__('Connexion',true));
			$this->set('title_for_layout', __('Connexion', true));
			//$this -> Session -> write("url", $this->params['url']);

			
			
			
			
			//pr($this -> data);
			if (!empty($this->data))
			{
				
				$this -> _navigation();
				
							
			}
			
		}
		
	}
?>
