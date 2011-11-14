<?php

class ConnexionController extends AppController {

		 var $helpers = array('Html', 'Form');  
		 var $name = 'Connexion';

		function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'non_connecte';
			$this->loadModel('Compte');
		}


		/**
		 * Écran de connexion
		 * @todo Erreur si mot de passe vide, changer mot de passe
		 * @bug Password ne se fait pas valider par le model ???
		 */
		 public function index() {
			$this->set('titre','Connexion des membres');
			$this->set('ariane', __('<span style="color: green;"> Connexion des membres', true));
			$this->set('title_for_layout', __('Inscription d\'un membre', true));
			
			// Si l'utilisateur existe, si son mot de passe est existant et si c'est le bon
			if (!empty($this->data)){
				$this->Connexion->set($this->data);
				if($this->Connexion->validates()) {

					//Gere les erreurs connexions BD, n'a pas réussi à être intégré avec le model alors fait manuellement
					if($this->Compte->find('all', array('conditions' => array('Compte.nom_utilisateur' => $this->data['Connexion']['nom_utilisateur'], 'Compte.mot_de_passe' => $this->data['Connexion']['mot_de_passe'])))){

						//Rediriger vers l'acceuil
						$this->redirect(array('action'=>'view'));
	
					}elseif ($this->Compte->find('all', array('conditions' => array('Compte.nom_utilisateur' => $this->data['Connexion']['nom_utilisateur'])))){

						$erreur = '<div class="error">' . __('Le mot de passe ne correspont pas au compte', true) . '</div><br>';	
						$this->set('erreur',$erreur);
					} else {

						$erreur = '<div class="error">' . __('Le compte n\'existe pas', true) . '</div><br>';	
						$this->set('erreur',$erreur);

					}
				

				}
			}
		}

		public function view() {

		}

	}
?>
