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

	function beforeFilter() {
		parent::beforeFilter();
		$this->loadModel('Adulte');
	}

	/**
	 * Page d'accueil du parent
	 * Elle lui souhaite bienvenu et affiche son nom
	 * @todo ajout des options de directions
	 */
	public function index() {
		$this->layout = 'parent';
		$this->set('titre', 'Accueil');
		$this->set('title_for_layout', __('Accueil', true));
		$this->_nom();
	}
	
	/**
	 * Page d'acceuil pour l'administrateur
	 * Elle lui souhaite bienvenu et affiche son nom
	 * @todo notification de l'administration
	 */
	public function admin() {
		$this->layout = 'admin';
		$this->set('titre', 'Accueil administrateur');
		$this->set('title_for_layout', __('Accueil', true));

		$this->_nom();
	}


	/**
	 * Cherche le nom de la personne connectée
	 */
	private function _nom(){
		$nom = $this->Adulte->find('all', array('conditions' => array('Adulte.id'=>$this->Session->read('authentification.id_adulte'))));
		$this->set('nom', $nom);
	}

}
?>
