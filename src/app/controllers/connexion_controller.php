<?php

/*
 * Page de connexion pour un utilisateur
 * @author Michel Biron
 * @author Luc-Frédéric Langis
 */
class ConnexionController extends AppController {

	var $helpers = array('Html', 'Form');
	var $name = 'Connexion';
	var $components = array('validerInformation');

	function beforeFilter() {

		parent::beforeFilter();
		$this->layout = 'non_connecte';
		$this->loadModel('Compte');
	}

	/*
	 * La fonction _navigation vérifie quel bouton a été cliqué et execute la bonne action
	 * Si le mot de passe n'est pas conforme à la personne dans la base de données, un message
	 * d'erreur est afficher (cette validation ne pouvait pas se faire dans le model, l'input doit s'appeller "password" pour être
	 * un champ mot de passe)
	 * @author Michel Biron
	 * @author Luc-Frédéric Langis
	 */
	private function _navigation() {

		//si le bouton connexion est cliqué
		if (array_key_exists('connexion', $this->params['form'])) {
			$resultat = $this->validerInformation->validerInformation($this->data['Connexion']['nom_utilisateur'], $this->data['Connexion']['password']);

			//si le mot de passe est valide
			if (!empty($resultat)) {
				$this->Session->write("authentification", $resultat);
				$this->redirect(array('controller' => 'accueil', 'action' => 'index'));
				//si le mot de passe n'est pas valide	
			} else {
				$this->Session->write("authentification", null);
				//initialise la balise d'erreur
				$erreurMDP = '<div  style="background: red">*Le compte ou le mot de passe est incorrect</div>';
				$this->set('erreurMDP', $erreurMDP);
			}
		} elseif (array_key_exists('inscrire', $this->params['form'])) {
			$this->redirect(array('controller' => 'inscrire_adulte', 'action' => 'index'));
		}
	}

	/**
	 * Initialisation de la page de connexion
	 * @author Michel Biron
	 */
	public function index() {
		$this->set('titre', __('Connexion', true));
		$this->set('title_for_layout', __('Connexion', true));
		//$this -> Session -> write("url", $this->params['url']);
		$this->_navigation();
	}

	public function detruire(){
			$this->Cookie->delete();
			$this->redirect(array( 'action' => 'index'));
	}

}
?>
