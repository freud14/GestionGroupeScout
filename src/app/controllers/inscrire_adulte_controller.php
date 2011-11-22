<?php

/**
* Controlleur qui gère ce qui est relié à la création de compte membre et à sa modification
* L'index (création de compte membre) peut être accéder sans qu'on soit connecter (sans session)
*/
class InscrireAdulteController extends AppController {

		 var $helpers = array('Html', 'Javascript', 'Form');  
		 var $name = 'InscrireAdulte';

		  var $components = array('validerInformation');
		// var $components = array(array('Recaptcha.Captcha' => array(
          //      'private_key' => '6Ldq4MkSAAAAACIFrlwaf209zjAOhktImcx_FjlS', 
            //    'public_key' => '6Ldq4MkSAAAAABiDfADZgxzR3Nn_wB4qppT9QBKy'))); 


		/**
		* Charge les modèles utiles au controlleur 
		*/
		function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'non_connecte';
			$this->loadModel('Compte');
			$this->loadModel('Adulte');
			$this->loadModel('AdultesImplication');
			$this->loadModel('Implication');
		}


		/**
		 * Permet à un parent de s'inscrire 
		 * @Author Luc-Frédéric Langis
		 * @return void
		 */
		public function index() {

			$this->set('titre','Devenir un membre');
			$this->set('ariane', __('<span style="color: green;">Inscription d\'un membre', true));
			$this->set('title_for_layout', __('Inscription d\'un membre', true));

			//Initialise les checkboxs d'implications
			$this->set('option',$this->_initImplication());
			
			//enregistrement des membres
				$this->_ajoutMembre();

	
			
		}


		/**
		 * Permet à un membre de modifier ses informations personnelles 
		 * @Author Luc-Frédéric Langis
		 * @return void
		 */

		public function profil(){
			$this->set('titre','Mon profil');
			$this->set('ariane', __('<span style="color: green;"> Mon profil', true));

			//Initialise les checkboxs d'implications
			$this->set('option',$this->_initImplication());

			//Initialise le profil
			$profil = $this->Adulte->find('first', array('conditions' => array('Adulte.compte_id' =>$this->Session->read('authentification.id_compte'))));
			
			//Initialise le profil
			$this->set('profil', $profil);

			$this->_majMembre();
			
		}	


		/**
		 * Vue simple qui permet de se rediriger vers la page d'accueil ou inscrire un enfant après l'inscription d'un membre 
		 * @Author Luc-Frédéric Langis
		 * @return void
		 */
		 public function view() {
			$this->set('titre','Inscription réussite avec succès');
			$this->set('ariane', __('<span style="color: green;">Inscription d\'un membre < Inscription réussite', true));
				
				//Action spécifique selon le bouton
				if ( array_key_exists ('inscrire',$this->params['form'])){
					//$this -> Session -> write("authentification",
					//			$this->validerInformation->validerInformation(	
							//$this->data['InscrireAdulte']['nom_utilisateur'],$this->data['InscrireAdulte']['mot_de_passe']);
					$this->redirect(array('controller'=>'information_generale', 'action'=>'index'));
					

 				}elseif( array_key_exists ('accueil',$this->params['form'])){
					$this->redirect(array('controller' => 'accueil', 'action' => 'index'));
				}
 	
		}



	
		/**
		 * Initilise la liste des implications par rapport à celle dans la base de données
		 * @return void
		 * @author Luc-Frédéric Langis
		 */
		private function _initImplication(){
			
			$implication = $this->Implication->find('all');
	
			$option = array();
			foreach($implication as $value){
					$option[$value['Implication']['id']] = $value['Implication']['nom'];
			}

			return $option;
		}



		/**
		 * Créer une session
		 * @return void
		 * @author Michel Biron
		 */

		private function _creerSession(){
		
		$resultat = $this->Compte->find('first', array('conditions' => $conditions,'fields' => 'Compte.id'));
    			pr($resultat);
			
			if(!empty($resultat))
			{
				$resultat = array('autorisation' => $resultat['Autorisation'],'id_compte' => $resultat['Compte']['id'],'id_adulte' => $resultat['Adulte']['0']['id']);	
			}
		}


		/**
		 *Enregistrement de membre
		 * @return void
		 * @author Luc-Frédéric Langis
		 */
		private function _ajoutMembre(){

			if (!empty($this->data)) {

						//Créer les intances de la bd nécessaire
						$this->Compte->create();
						$this->Adulte->create();
					
					
					$this->InscrireAdulte->set($this->data);
						if($this->InscrireAdulte->validates()) {
							//Enregistrement des données dans la base de données
							if ($this->Compte->save(array('nom_utilisateur' => $this->data['InscrireAdulte']['nom_utilisateur'], 
														'mot_de_passe' => $this->data['InscrireAdulte']['mot_de_passe'])) && 
										($this->Adulte->save(array('prenom' => $this->data['InscrireAdulte']['prenom'], 
													   'nom' => $this->data['InscrireAdulte']['nom'], 
													   'tel_maison' => $this->data['InscrireAdulte']['tel_maison'], 
													   'sexe' => $this->data['InscrireAdulte']['sexe'], 
													   'tel_bureau' => $this->data['InscrireAdulte']['tel_bureau'], 
													   'poste_bureau' => $this->data['InscrireAdulte']['poste_bureau'], 
													   'profession' => $this->data['InscrireAdulte']['profession'], 
													   'courriel'=> $this->data['InscrireAdulte']['nom_utilisateur'], 
													   'compte_id' => $this->Compte->id, 
													   'tel_autre' => $this->data['InscrireAdulte']['tel_autre'])))){
								
									//Si une implication est existante	
								if ((isset($this->data['InscrireAdulte']['Implication'])) && (!empty($this->data['InscrireAdulte']['Implication']))){
									
									foreach($this->data['InscrireAdulte']['Implication'] as $impl) {
										$this->AdultesImplication->create();
										$this->AdultesImplication->save(array('implication_id' => $impl, 'adulte_id' => $this->Adulte->id));
									}
								}
									//Si l'enregistrement a bien été fait, affiche le bon messasge
									$this->Session->setFlash(__('Inscription terminée', true));
								} else {
								$this->Session->setFlash(__('Oups, petite erreur, veuillez ressayer plus tard', true));
							}
<<<<<<< HEAD
						}
							//Si l'enregistrement a bien été fait, affiche le bon messasge
							$this->Session->setFlash(__('Inscription terminée', true));
							$this -> Session -> write("authentification",
										$this->validerInformation->validerInformation(
										$this->data['InscrireAdulte']['nom_utilisateur'],
										$this->data['InscrireAdulte']['mot_de_passe']
											)
										);
							 $this->redirect(array('action' => 'view'));
						} else {
						$this->Session->setFlash(__('Oups, petite erreur, veuillez ressayer plus tard', true));
					}
				} 
		}	
=======
						} 
				}	
	}



	/**
		 *Met à jour le profil de membre
		 * @author Luc-Frédéric Langis
		 * @see J'ai du faire deux fonctions pour la mise à jour et l'inscription, sinon cela occassionnais des conflits d'id et d'unicité
		 * @return void
		 */

	private function _majMembre(){

			if (!empty($this->data)) {

					$this->InscrireAdulte->set($this->data);
						if($this->InscrireAdulte->validates()) {
							//Enregistrement des données dans la base de données
							if ($this->Compte->save(array('id' => $this->Session->read('authentification.id_compte'),
														'nom_utilisateur' => $this->data['InscrireAdulte']['nom_utilisateur'], 
														'mot_de_passe' => $this->data['InscrireAdulte']['mot_de_passe'])) && 
										($this->Adulte->save(array('id'=>$this->Session->read('authentification.id_adulte'),
													   'prenom' => $this->data['InscrireAdulte']['prenom'], 
													   'nom' => $this->data['InscrireAdulte']['nom'], 
													   'tel_maison' => $this->data['InscrireAdulte']['tel_maison'], 
													   'sexe' => $this->data['InscrireAdulte']['sexe'], 
													   'tel_bureau' => $this->data['InscrireAdulte']['tel_bureau'], 
													   'poste_bureau' => $this->data['InscrireAdulte']['poste_bureau'], 
													   'profession' => $this->data['InscrireAdulte']['profession'], 
													   'courriel'=> $this->data['InscrireAdulte']['nom_utilisateur'], 
													   'compte_id' => $this->Session->read('authentification.id_compte'),
													   'tel_autre' => $this->data['InscrireAdulte']['tel_autre'])))){
								
									//Si une implication est existante	
								if ((isset($this->data['InscrireAdulte']['Implication'])) && (!empty($this->data['InscrireAdulte']['Implication']))){
									
									//Supprimer les implications avant pour éviter conflit
									$this->AdultesImplication->deleteAll(array('adulte_id' => $this->Session->read('authentification.id_adulte')));
									
									foreach($this->data['InscrireAdulte']['Implication'] as $impl) {
										$this->AdultesImplication->create();
										$this->AdultesImplication->save(array('implication_id' => $impl, 'adulte_id' => $this->Session->read('authentification.id_adulte')));
									}
								}
									//Si l'enregistrement a bien été fait, affiche le bon messasge
									$this->Session->setFlash(__('Inscription terminée', true));
								} else {
								$this->Session->setFlash(__('Oups, petite erreur, veuillez ressayer plus tard', true));
							}
						} 
				}	
>>>>>>> 079fd68982e161c16905962b555428f4be298e8e
	}

}
?>
