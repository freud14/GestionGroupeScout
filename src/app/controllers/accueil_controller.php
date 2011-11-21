<?php
//App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class AccueilController extends AppController {

		 var $helpers = array('Html', 'Form');  
		 var $name = 'Accueil';

		function beforeFilter(){
			parent::beforeFilter();
		}


		/**
		 * Affiche l'ensemble des enfants selon leur unité.
		 * On peut changer l'affichage pour voir un tableau d'unité spécifique
		 * @todo  faire l'exportation excel
		 */
		 public function index() {
			$this->set('titre','Accueil');
			$this->set('title_for_layout', __('Accueil', true));
		}
		
}



?>
