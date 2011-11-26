<?php

/**
 * Cette classe gère la gestion des paiements pour
 * les parents.
 */
class ListeProfilEnfantController extends AppController {

	/**
	 * Le nom du contrôleur
	 * @var string
	 */
	var $name = 'ListeProfilEnfant';

	/**
	 * Les différents Helpers utilisés par le contrôleur et la vue.
	 * @var array
	 */
	var $helpers = array("Html");

	/**
	 * Cette méthode initialise le contrôleur.
	 */
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		setlocale(LC_ALL, 'fr_CA.utf8');
		$this->set('title_for_layout', __('Profil des enfants', true));
	}

	function index() {
		$this->set('titre', __('Profil des enfants', true));
		$this->set('ariane', __('Profil des enfants', true));
		
		$this->set('enfants', $this->ListeProfilEnfant->getListeEnfant($this->Session->read('authentification.id_adulte')));			
	}

}

?>
