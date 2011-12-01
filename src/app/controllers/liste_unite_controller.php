<?php

/**
 * Permet de controller toutes les intéractions d'unités
 * Par rapport aux listes des unités, aux assignations
 * des enfants dans les unités et aux assignations des
 * animateurs
 *
 * @author Luc-Frédéric Langis
 * @author Michel Biron
 */
class ListeUniteController extends AppController {

	var $helpers = array('Html', 'Form');
	var $name = 'ListeUnite';

	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
		$this->loadModel('Unite');
		$this->loadModel('Inscription');
		$this->loadModel('Adulte');
		$this->loadModel('AdultesUnite');
		$this->loadModel('AutorisationsCompte');
		$this->loadModel('Compte');
		$this->loadModel('Annee');
		$this->loadModel('Autorisation');
		$this->loadModel('AdultesUnite');
	}

	/**
	 * Affiche l'ensemble des enfants selon leur unité.
	 * On peut changer l'affichage pour voir un tableau d'unité spécifique
	 * @author Luc-Frédéric Langis
	 * @author Michel Biron
	 */
	public function index() {


		$this->set('titre', 'Liste des unités');
		$this->set('ariane', __('<span style="color: green;">Liste </span> > Liste des unités', true));
		$this->set('title_for_layout', __('Liste des unités', true));
		$nomUnite = $this->_listeOption('Tous', 'option');
		//Si une valeure autre que tous a été choisie
		if ((!empty($this->data['ListeUnite'])) && ($this->data['ListeUnite']['Afficher'] != "0")) {

			$unite = $this->Unite->find('all', array('recursive' => 2,
				    'conditions' => array('Unite.Id' => $this->data['ListeUnite']['Afficher'], 'Unite.nom' => $nomUnite)));
		} else {

			$unite = $this->Unite->find('all', array('recursive' => 2, 'conditions' => array('Unite.Nom ' => $nomUnite)));
		}

		$this->set('unite', $unite);
	}

	/**
	 * Permet de gérer l'asssignation des jeunes
	 * à une unité spécifique et de les retirer
	 * @author Luc-Frédéric Langis
	 */
	public function assigner() {
		if ($this->_getAutorisation() <= 2) {
			$this->redirect(array('controller' => 'accueil', 'action' => 'index'));
		}
		$this->set('titre', 'Assigner des jeunes dans une unité');
		$this->set('ariane', __('<span style="color: green;">Gestion des unités </span> > Assigner un jeune', true));
		$this->set('title_for_layout', __('Assigner un jeune', true));



		//Action spécifique selon le bouton
		if (array_key_exists('assigner', $this->params['form'])) {

			$this->_assignerEnfant();
		} elseif (array_key_exists('retirer', $this->params['form'])) {
			$this->_retirerEnfant();
		} elseif (array_key_exists('voir', $this->params['form'])) {
			$this->_voirAssigner();
		}
		$this->_voirAssigner();
	}

	/**
	 * Permet de gérer l'asssignation des animateurs
	 * à une unité spécifique et de les retirer
	 * @author Luc-Frédéric Langis
	 * @author Michel Biron
	 */
	public function assigner_animateur() {
		if ($this->_getAutorisation() <= 2) {
			$this->redirect(array('controller' => 'accueil', 'action' => 'index'));
		}
		$this->set('titre', 'Assigner des animateurs dans une unité');
		$this->set('ariane', __('<span style="color: green;">Gestion des unités </span> > Assigner un jeune', true));
		$this->set('title_for_layout', __('Assigner un animateur', true));

		//Recherche les untiés
		$tabUnite = $this->Unite->find('all', array('recursive' => 2, 'order' => array('GroupeAge.age_min ASC')));

		$listeUnite = array();
		//Donne la liste de toutes les unitées ainsi que leurs animateur
		foreach ($tabUnite as $valeur) {

			$animateur = array();
			foreach ($valeur['Adulte'] as $adulteValeur) {
				$animateur[] = $adulteValeur['id'];
			}
			$listeUnite[$valeur['Unite']['id']] = array('nom' => $valeur['Unite']['nom'], 'adulte' => $animateur);
		}

		$listeAnimateur = array();
		$tabAnimateur = $this->Autorisation->find('all', array('recursive' => 2, 'conditions' => array('Autorisation.id' => 1)));


		//Donne la liste de tout les comptes avec des droits d'animateur
		foreach ($tabAnimateur[0]['Compte'] as $valeur) {

			$listeAnimateur[$valeur['Adulte'][0]['id']] = $valeur['Adulte'][0]['prenom'] . ' ' . $valeur['Adulte'][0]['nom'];
		}


		$this->set('listeAnimateur', $listeAnimateur);
		$this->set('listeUnite', $listeUnite);

		if (array_key_exists('assigner', $this->params['form'])) {

			$this->_enregistrerAnimateur();
		}
	}

	/*
	 * Enregistre les animateurs assignés à une nouvelle unité
	 * Et retirer ceux décochés de l'unité
	 * @author Luc-Frédéric Langis
	 */

	private function _enregistrerAnimateur() {


		$adultesUnite = $this->AdultesUnite->find('all');
		$unite = $this->Unite->find('all', array('recursive' => -1));

		$vieuxAnimateur = array();
		$nouveauAnimateur = (array) $this->data['AssignerAnimateur'];

		//On va chercher les anciens animateurs et leurs unités
		//Dans le même format que le $this->data
		foreach ($unite as $valeur) {

			$vieuxAnimateur[$valeur['Unite']['id']] = null;
			foreach ($adultesUnite as $valeur2) {

				$vieuxAnimateur[$valeur['Unite']['id']] = $valeur2['AdultesUnite']['adulte_id'];
			}
		}

		//On compare si les données ont changé
		//SI on oui on supprime l'instance et on en créer une nouvelle
		//Avec la bonne unité
		foreach ($nouveauAnimateur as $cle => $animateur) {
			if ($animateur != $vieuxAnimateur[$cle]) {

				//on enleve les anciens droits pour ne pas faire de conflit
				$this->AdultesUnite->deleteAll(array('unite_id' => $cle));
				//si le membre a de nouveau droit on les ajoutes
				if (!empty($animateur)) {
					// On creer les nouveaux droits du membre
					foreach ($animateur as $valeur2) {
						$this->AdultesUnite->create();
						$this->AdultesUnite->save(array('adulte_id' => $valeur2, 'unite_id' => $cle));
					}
				}
			}
		}

		$this->redirect(array('controller' => 'liste_unite', 'action' => 'assigner_animateur'));
	}

	/*
	 * Gère la gestion de l'affichage des enfants
	 * par unité et le trie selon la sélection de l'unité
	 * @author Luc-Frédéric Langis
	 */

	private function _voirAssigner() {

		//Option pour la liste déroulante
		$nomUnite = $this->_listeOption('Jeunes non assignés', 'option');
		$this->_listeOption(null, 'optionAssignation');

		//Cherche l'année actuelle soit qui n'est pas finit donc pas de date de fin
		$annee = $this->Annee->find('first', array('conditions' => array('Annee.date_fin' => null)));
		//Si les jeunes non assignés ne sont pas sélectionner affiche les bons enfants dans les bonnes unités
		if ((!empty($this->data['Assigner'])) && ($this->data['Assigner']['Afficher'] != "0")) {

			$unite = $this->Inscription->find('all', array('recursive' => 2,
				    'conditions' => array('Inscription.unite_id' => $this->data['Assigner']['Afficher'],
					'Inscription.annee_id' => $annee['Annee']['id'])));
			$titreUnite = $nomUnite[$this->data['Assigner']['Afficher']];
		} else {

			$unite = $this->Inscription->find('all', array('conditions' => array('Inscription.unite_id' => null,
					'Inscription.annee_id' => $annee['Annee']['id'])));


			$titreUnite = 'Jeune non assignés';
		}

		$this->set('titreUnite', $titreUnite);
		$this->_initEnfant($unite);
	}

	/*
	 * Initialise la liste d'enfant lors des recherches
	 * et des changements d'affichage
	 * @author Luc-Frédéric Langis
	 * @param $requete requete pour chercher les enfants selon l'unité
	 */

	private function _initEnfant($requete) {
		$enfant = array();
		foreach ($requete as $valeur) {
			$enfant[$valeur['Enfant']['id']] = array('nom' => $valeur['Enfant']['prenom'] . ' ' . $valeur['Enfant']['nom'],
			    'sexe' => $valeur['Enfant']['sexe'],
			    'naissance' => $valeur['Enfant']['date_naissance'],
			    'groupe' => $valeur['GroupeAge']['nom'] . "( " .
			    $valeur['GroupeAge']['age_min'] . " - "
			    . $valeur['GroupeAge']['age_max'] . ")"
			);
		}

		$this->set('enfant', $enfant);
	}

	/**
	 * Donne la liste des noms que le membre peut voir
	 * @param $option1  le nom du premier champ de la liste déroulante
	 * @return la liste des noms des unités que le membre peut voir selon ses droits d'accès
	 * @author Michel Biron
	 * @author Luc-Frédéric Langis
	 */
	private function _listeOption($option1, $nomVar) {

		$autorisation = $this->_getAutorisation();
		$droplist = array();
		$option = array();
		if (isset($option1)) {
			$option[] = $option1;
		}
		//s'il n'a pas d'autorisation (un parent) on le renvoit a laccueil
		if (empty($autorisation)) {
			$this->redirect(array('controller' => 'accueil', 'action' => 'index'));
		}
		//si c'est un animateur on affiche juste les unites auquel il est assigné
		elseif ($autorisation == 1) {
			$unite = $this->Compte->find('all', array('recursive' => 2,
				    'conditions' => array(
					'Compte.Id' => $this->Session->read('authentification.id_compte')))
			);
			$unite = $unite['0']['Adulte']['0']['Unite'];
			foreach ($unite as $valeur) {
				$option[$valeur['id']] = $valeur['nom'];
			}
		}
		//s'il a les droits de consultations(ou plus) on affiche toutes les unités
		else {
			$unite = $this->Unite->find('all');
			foreach ($unite as $valeur) {
				$option[$valeur['Unite']['id']] = $valeur['Unite']['nom'];
			}
		}


		$this->set($nomVar, $option);
		return $option;
	}

	/**
	 * Assigne un jeune à une nouvelle unité
	 * @author Luc-Frédéric Langis
	 */
	private function _assignerEnfant() {


		$uniteAssigner = array();
		$enfantId = array();

		//Divise le $this->data puisque l'assignation ne peut être changer au niveau de l'index, on doit les séparer
		foreach ($this->data['Assigner'] as $cle => $inscription) {
			if ($cle != 'assignation' && $cle != 'Afficher') {
				$enfantId[$cle] = $inscription;
			} else {
				$uniteAssigner[$cle] = $inscription;
			}
		}

		//Parcours le tableau diviser pour chacun des enfants
		foreach ($enfantId as $cle => $inscription) {
			if (!empty($inscription)) {
				$enfant = array();

				$annee = $this->Annee->find('first', array('conditions' => array('Annee.date_fin' => null)));

				//On recherche l'id de l'inscription relié à l'enfant
				$enfant = $this->Inscription->find('first', array('conditions' => array('Inscription.enfant_id' => $cle, 'Inscription.annee_id' => $annee['Annee']['id'])));

				//Enregistrement de l'inscription à la nouvelle unité
				$this->Inscription->save(array('id' => $enfant['Inscription']['id'],
				    'unite_id' => $uniteAssigner['assignation']));
			}
		}
	}

	/**
	 * Retire un jeune d'une unité
	 * @author Luc-Frédéric Langis
	 */
	private function _retirerEnfant() {
		$enfantId = array();

		//Divise le $this->data puisque l'assignation ne peut être changer au niveau de l'index, on doit les séparer
		// Puisque les enfants sont retirer, on ne prend pas l'unité sélectionner par défaut dans le $this->data
		foreach ($this->data['Assigner'] as $cle => $inscription) {
			if ($cle != 'assignation' && $cle != 'Afficher') {
				$enfantId[$cle] = $inscription;
			}
		}

		//Parcours le tableau diviser pour chacun des enfants
		foreach ($enfantId as $cle => $inscription) {
			if (!empty($inscription)) {
				$enfant = array();

				$annee = $this->Annee->find('first', array('conditions' => array('Annee.date_fin' => null)));

				//On recherche l'id de l'inscription relié à l'enfant
				$enfant = $this->Inscription->find('first', array('conditions' => array('Inscription.enfant_id' => $cle, 'Inscription.annee_id' => $annee['Annee']['id'])));

				//Enregistrement de l'inscription à la nouvelle unité
				$this->Inscription->save(array('id' => $enfant['Inscription']['id'],
				    'unite_id' => null));
			}
		}
	}

}
?>
