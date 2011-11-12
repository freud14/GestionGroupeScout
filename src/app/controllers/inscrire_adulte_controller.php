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
			$this->layout = 'parent';
			$this->loadModel('Compte');
			$this->loadModel('Adulte');
			$this->loadModel('AdultesImplication');
		}


		/**
		 * view method
		 *
		 * @param string $id
		 * @return void
		 */
		 public function view() {
			}

		/**
		 * add method
		 *
		 * @return void
		 */
		public function inscription() {

			$this->set('titre','Devenir un membre');
			$this->set('ariane', __('<span style="color: green;">Inscription d\'un membre', true));
			$this->set('title_for_layout', __('Inscription d\'un membre', true));

			if (!empty($this->data)) {

			$this->Compte->create();
			$this->Adulte->create();
			$this->AdultesImplication->create();

			$this->Compte->save(array('nom_utilisateur' => $this->data['InscrireAdulte']['nom_utilisateur'], 'mot_de_passe' => $this->data['InscrireAdulte']['mot_de_passe']));

			$this->Adulte->save(array('prenom' => $this->data['InscrireAdulte']['prenom'], 'nom' => $this->data['InscrireAdulte']['nom'], 'tel_maison' => $this->data['InscrireAdulte']['tel_maison'], 'sexe' => $this->data['InscrireAdulte']['gender'], 'tel_bureau' => $this->data['InscrireAdulte']['tel_bureau'], 'poste_bureau' => $this->data['InscrireAdulte']['poste_bureau'], 'profession' => $this->data['InscrireAdulte']['profession'], 'courriel'=> $this->data['InscrireAdulte']['nom_utilisateur'], 'compte_id' => $this->Compte->id));
		
		$this->AdultesImplication->save(array('id_adulte' => $this->AdultesImplication->id));
			echo	$this->Compte->id;

			pr($this->data);

		//	if ($this->Compte->save($this->data) && ($this->Adulte->save($this->data)) && ($this->AdultesImplication->save($this->data))) {
				$this->Session->setFlash(__('Inscription terminée', true));

				echo 'yes';
		//	} else {
		//		$this->Session->setFlash(__('Oups, petite erreur, veuillez ressayer plus tard', true));
		//		echo 'no';
		//	}
		}

		}
		
}
?>
