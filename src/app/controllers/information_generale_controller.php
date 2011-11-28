<?php

/**
 * Cette classe gère la page des informations générales 
 * pour l'inscription.
 */
class InformationGeneraleController extends AppController {

	/**
	 * Le nom du contrôleur
	 * @var type string
	 */
	var $name = 'InformationGenerale';

	/**
	 * Les différents Helpers utilisés par le contrôleur et la vue.
	 * @var type array
	 */
	var $helpers = array("Html", 'Form');
	var $components = array('supprimer');

	/**
	 * Cette méthode initialise le contrôleur.
	 */
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		$this->loadModel('GroupeAge');
	}

	/*
	 * La fonction _navigation vérifie quel bouton a été cliqué et execute la bonne action
	 */

	private function _navigation() {

		if (array_key_exists('suivant', $this->params['form'])) {
			//Si le bouton suivant est cliquer				

			$this->InformationGenerale->set($this->data);

			if ($this->InformationGenerale->validates()) {
				//si les champs sont bien remplits	
				$this->redirect(array('controller' => 'inscription_fiche_med', 'action' => 'index'));
			}
		} elseif (array_key_exists('annuler', $this->params['form'])) {
			$this->supprimer->supprimerInscription($this);
			$this->redirect(array('controller' => 'accueil', 'action' => 'index'));
			//DEVRAIT REDIRIGER VERS L'ACCUEIL
		}
	}

	/**
	 * Cette méthode initialise et gère la page des 
	 * informations générales.
	 */
	function index() {
		//si la page ne c'est pas rapeler elle même
		if (empty($this->data)) {
			//Si ce n'est pas la page qui renvoit vers elle même
			$informationGenerale = $this->Session->read('info_gen.InformationGenerale');
			//Si la variable session est vide
			if (empty($informationGenerale)) {
				//s'il n'y a pas de données sauvegargées
				$informationGenerale = array(
					'nom' => "", 'prenom' => "", 'sexe' => "",
					'date_de_naissance' => array('day' => "", 'month' => "", 'year' => ""),
					'assurance_maladie' => "", 'adresse' => "", 'ville' => "", 'code_postal' => "", 'etab_scolaire' => "",
					'niveau_scolaire' => "", 'enseignant' => "", 'groupe_age' => "", 'nom_tuteur' => "",
					'prenom_tuteur' => "", 'sexe_tuteur' => "", 'courriel_tuteur' => "", 'telephone_maison_tuteur' => "",
					'telephone_bureau_tuteur' => "", 'telephone_bureau_poste_tuteur' => "", 'cellulaire_tuteur' => "",
					'emploi_tuteur' => "", 'nom_urgence' => "", 'prenom_urgence' => "", 'telephone_principal_urgence' => "",
					'lien_jeune_urgence' => "", 'particularite' => ""
				);
			}
			//Si c'est la page qui renvoit vers elle même on enregistre les informations et on appelle _navigation
		} else {
			$this->Session->write('info_gen', $this->params['data']);
			$this->_navigation();
			$informationGenerale = $this->Session->read('info_gen.InformationGenerale');
		}

		$this->set('title_for_layout', __('Inscription d\'un enfant', true));
		$this->set('titre', __('Informations générales', true));
		$this->set('ariane', __('<span style="color: green;">Informations générales</span> > Fiches médicales > Autorisations', true));

		$this->set('groupe_age', $this->GroupeAge->find('all'));
		$this->set('session', $informationGenerale);
	}

}
?>

