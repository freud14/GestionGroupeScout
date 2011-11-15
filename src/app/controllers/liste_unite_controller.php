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
			$this->loadModel('Enfant');
		}


		/**
		 * Affiche l'ensemble des enfants selon leur unité.
		 * On peut changer l'affichage pour voir un tableau d'unité spécifique
		 * @todo  faire l'exportation excel
		 */
		 public function index() {
			$this->set('titre','Liste des unités');
			$this->set('ariane', __('<span style="color: green;">Liste </span> > Liste des unités', true));
			$this->set('title_for_layout', __('Liste des unités', true));

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

			$this->_listeOption('Tous');
			$this->set('unite', $unite);
		}

		/**
		 * Définit les options pour les droplists
		 * Donne un nom au premier élément et met le nom
		 * des unités par la suite
		 */
		private function _listeOption($option1){
			//Permet d'afficher les éléments de la droplist
			$droplist = $this->Unite->find('all', array('recursive' => 2));
			$option = array();
			$enfant = array();

			$option[] = $option1;
	
		
			foreach($droplist as $value){
			
				$option[$value['Unite']['id']] = $value['Unite']['nom'];		
							
			}

			$this->set('option', $option);

		}

		/**
		 * Permet d'assigner les jeunes à leur unité 
		 * @todo  faire l'exportation excel
		 */
		 public function assigner() {
			$this->set('titre','Assigner des jeunes dans une unité');
			$this->set('ariane', __('<span style="color: green;">Gestion des unités </span> > Assigner un jeune', true));
			$this->set('title_for_layout', __('Assigner un jeune', true));


			//Option pour la droplist
			$this->_listeOption('Jeunes non assignés');
					
			//Cherche les enfants et vérifie s'ils ont une unité pour distinguer les jeunes non assignés et assignés
			pr($enfant);
			
			//Change la requête selon la sélection dans le droplist d'affichage, elle affiche les tableaux
		 	if (!empty($this->data['Voir'])){

				if($this->data['Voir']['Afficher'] == "0"){
					$unite = $this->Enfant->find('all', array('recursive' => 2));
				} else {

					$unite = $this->Enfant->find('all', array('recursive' => 2, 'conditions' => array('Unite.Id' => $this->data['ListeUnite']['Afficher'])));

				}	
			} else {

					$enfant = $this->Enfant->find('all', array('recursive' => 2));
			
			}
		 } 
		
}


?>
