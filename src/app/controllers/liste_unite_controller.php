<?php
//App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class ListeUniteController extends AppController {

		 var $helpers = array('Html', 'Form');  
		 var $name = 'ListeUnite';

		function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'admin';
			$this->loadModel('Unite');
		}


		/**
		 * Affiche l'ensemble des enfants selon leur unité.
		 * On peut changer l'affichage pour voir un tableau d'unité spécifique
		 * @todo  faire l'exportation excel
		 */
		 public function index() {
	
		//Change la requête selon la sélection dans le droplist d'affichage, elle affiche les tableaux
		 if (!empty($this->data['ListeUnite'])){

			if($this->data['ListeUnite']['Afficher'] == "0"){
				$unite = $this->Unite->find('all', array('recursive' => 2));
			} else {

				$unite = $this->Unite->find('all', array('recursive' => 2, 'conditions' => array('Unite.Id' => $this->data['ListeUnite']['Afficher'])));

			}	
		} else {

				$unite = $this->Unite->find('all', array('recursive' => 2));
			
		}

			//Permet d'afficher les éléments de la droplist
			$droplist = $this->Unite->find('all', array('recursive' => 2));
			$option = array();
			$enfant = array();

			$option[] = 'Tous';
	
		
			foreach($droplist as $value){
			
				$option[$value['Unite']['id']] = $value['Unite']['nom'];		
							
			}


		//	pr($enfant);
			$this->set('titre','Liste des unités');
			$this->set('ariane', __('<span style="color: green;">Liste </span> > Liste des unités', true));
			$this->set('title_for_layout', __('Liste des unités', true));
			
			$this->set('option', $option);
			$this->set('unite', $unite);
		}

	}
?>
