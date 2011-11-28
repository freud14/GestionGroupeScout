<?php

class InscriptionConfirmationController extends AppController {

	var $name = 'InscriptionConfirmation';
	var $helpers = array("Html", 'Form');

	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		setlocale(LC_ALL, 'fr_CA.utf8');
	}

	function index() {
		$nom = $this->Session->read('info_gen.InformationGenerale.prenom');
		$this->Session->write('info_gen', null);
		$this->Session->write('fiche_med', null);
		$this->Session->write('InscriptionAutorisation', null);
		$this->_navigation();
		$this->set('title_for_layout', __('Inscription d\'un enfant réussie', true));
		$this->set('titre', __('Fin de l\'inscrtiption', true));

		$this->set('nom', $nom);
	}

	/*
	 * La fonction _navigation vérifie quel bouton a été cliqué et execute la bonne action
	 */

	private function _navigation() {
		//si le bouton accepter est cliqué
		if (array_key_exists('paiement', $this->params['form'])) {
			$this->Session->write("session", $this->params['data']);
			$this->redirect(array('controller' => 'gestionnaire_paiement', 'action' => 'index'));
			//si le bouton précédent est cliqué
		} elseif (array_key_exists('inscription', $this->params['form'])) {
			$this->redirect(array('controller' => 'information_generale', 'action' => 'index'));
		} elseif (array_key_exists('accueil', $this->params['form'])) {
			$this->redirect(array('controller' => 'accueil', 'action' => 'index'));
		}
	}

}
?>
