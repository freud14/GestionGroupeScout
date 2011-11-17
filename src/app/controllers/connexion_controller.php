<?php

class ConnexionController extends AppController {

		 var $helpers = array('Html', 'Form');  
		 var $name = 'Connexion';

		function beforeFilter(){
			$this -> Session -> write("url", $this->params['url']);
			parent::beforeFilter();
			$this->layout = 'non_connecte';
			$this->loadModel('Compte'); 
		}
		 public function navigation() {
		
			//si le bouton connexion est cliqué
			if ( array_key_exists ('connexion',$this->params['form']))
 			{
 				$resultat = $this->validerInformation($this->data['Connexion']['nom_utilisateur'],$this->data['Connexion']['mot_de_passe']);		
				
				//si le mot de passe est valide
				if(!empty($resultat))
				{
					$this -> Session -> write("authentification", $resultat);
					$this->redirect(array('controller'=>'information_generale', 'action'=>'index'));
					
				}else{
					$this -> Session -> write("authentification", null);
					pr("looser");
				}
 				$this->redirect(array('controller'=>'information_generale', 'action'=>'index'));
 			//
 			/*}elseif( array_key_exists ('suivant',$this->params['form']))
 			{
 			//si le bouton suivant est cliqué	
 				$this->redirect(array('controller'=>'inscription_autorisation', 'action'=>'index'));
 			
 			*/
 	
			}
		}

		/**
		 * Écran de connexion
		 * @todo Erreur si mot de passe vide, changer mot de passe
		 * @bug Password ne se fait pas valider par le model ???
		 */
		 public function index() {
			$this->set('titre',__('Connexion',true));
			$this->set('title_for_layout', __('Connexion', true));
			$this -> Session -> write("url", $this->params['url']);

			
			
			
			
			pr($this -> data);
			if (!empty($this->data))
			{
				
				$this -> navigation();
				
				$resultat = $this->validerInformation($this->data['Connexion']['nom_utilisateur'],$this->data['Connexion']['mot_de_passe']);
				
				
				//si le mot de passe est valide
				if(!empty($resultat))
				{
					$this -> Session -> write("authentification", $resultat);
					$this->redirect(array('controller'=>'information_generale', 'action'=>'index'));
					
				}else{
					$this -> Session -> write("authentification", null);
					pr("looser");
				}
				
			}
			
		}
		function validerInformation($nom_utilisateur,$mot_de_passe)
		{
			$resultat = null;
    			$conditions = array("Compte.nom_utilisateur" => $nom_utilisateur,'Compte.mot_de_passe' => $mot_de_passe);    			
    			$resultat = $this->Compte->find('first', array('conditions' => $conditions,'fields' => 'Compte.id'));
    			
			
			if(!empty($resultat))
			{
				$resultat = array('autorisation' => $resultat['Autorisation'],'id_compte' => $resultat['Compte']['id']);	
			}
			
			
		return $resultat;
			//return $this->QuestionGenerale->find('all');
		}
	}
?>
