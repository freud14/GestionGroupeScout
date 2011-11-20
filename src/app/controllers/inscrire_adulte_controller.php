<?php
//App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class InscrireAdulteController extends AppController {

		 var $helpers = array('Html', 'Javascript', 'Form');  
		 var $name = 'InscrireAdulte';
		// var $components = array(array('Recaptcha.Captcha' => array(
          //      'private_key' => '6Ldq4MkSAAAAACIFrlwaf209zjAOhktImcx_FjlS', 
            //    'public_key' => '6Ldq4MkSAAAAABiDfADZgxzR3Nn_wB4qppT9QBKy'))); 

		function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'non_connecte';
			$this->loadModel('Compte');
			$this->loadModel('Adulte');
			$this->loadModel('AdultesImplication');
			$this->loadModel('Implication');
		}


		/**
		 * Initialise les noms de la view inscription
		 * Appelle la fonction d'enregistrement de membre
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

		public function profil(){
			$this->set('titre','Mon profil');
			$this->set('ariane', __('<span style="color: green;"> Mon profil', true));

			//Initialise les checkboxs d'implications
			$this->set('option',$this->_initImplication());

			//Initialise le profil
			$profil = $this->Adulte->find('first', array('conditions' => array('Adulte.compte_id' =>$this->Session->read('authentification.id_compte'))));
			
			//Initialise le profil
			$this->set('profil', $profil);

			$this->_ajoutMembre();
			
		}	


		/**
		 * view method
		 *
		 * @param string $id
		 * @return void
		 */
		 public function view() {
			$this->set('titre','Inscription réussite avec succès');
			$this->set('ariane', __('<span style="color: green;">Inscription d\'un membre < Inscription réussite', true));

				if ( array_key_exists ('inscrire',$this->params['form'])){

					 $this->redirect(array('controller' => 'InformationGenerale', 'action' => 'index'));

 				}elseif( array_key_exists ('accueil',$this->params['form'])){
					$this->redirect(array('controller' => 'Connexion', 'action' => 'index'));
				}
 	
		}



	
		/**
		 *Enregistrement de membre
		 * @return void
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
		 *Enregistrement de membre
		 * @return void
		 */
		private function _ajoutMembre(){

			if (!empty($this->data)) {

					//Créer les intances de la bd nécessaire
					$this->Compte->create();
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
												   'sexe' => $this->data['InscrireAdulte']['genre'], 
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
								$this->redirect(array('action'=>'view'));
						} else {
							$this->Session->setFlash(__('Oups, petite erreur, veuillez ressayer plus tard', true));
						}
			} 
		}	
	}

}
?>
