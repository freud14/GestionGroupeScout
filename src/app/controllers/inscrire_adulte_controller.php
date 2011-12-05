<?php

/**
 * Gère ce qui est relié à la création de compte membre et à sa modification(profil)
 * L'index (création de compte membre) peut être accéder sans qu'on soit connecter (sans session)
 * @Author Luc-Frédéric Langis
 */
class InscrireAdulteController extends AppController {

    var $helpers = array('Html', 'Javascript', 'Form');
    var $name = 'InscrireAdulte';
    var $components = array('validerInformation');

    /**
     * Charge les modèles utiles au controlleur
     */
    function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'non_connecte';
        $this->loadModel('Compte');
        $this->loadModel('Adulte');
        $this->loadModel('AdultesImplication');
        $this->loadModel('Implication');
        $this->loadModel('AutorisationsCompte');
    }

    /**
     * Permet à un parent de s'inscrire via un formulaire
     * de création de compte
     * @Author Luc-Frédéric Langis
     */
    public function index() {

        $this->set('titre', 'Devenir un membre');
        $this->set('ariane', __('<span style="color: green;">Inscription d\'un membre', true));
        $this->set('title_for_layout', __('Inscription d\'un membre', true));

		$this->_navigation();
		
        //Initialise les checkboxs d'implications
        $this->set('option', $this->_initImplication());
		
       
    }

    /**
     * Vue simple qui permet de se rediriger vers la page d'accueil ou inscrire un enfant après l'inscription d'un membre 
     * @Author Luc-Frédéric Langis
     * @return void
     */
    public function view() {
        $this->layout = 'parent';
        $this->set('titre', 'Inscription réussite avec succès');
        $this->set('ariane', __('<span style="color: green;">Inscription d\'un membre < Inscription réussite', true));

        //Action spécifique selon le bouton
        if (array_key_exists('inscrire', $this->params['form'])) {
            //$this -> Session -> write("authentification",
            //			$this->validerInformation->validerInformation(
            //$this->data['InscrireAdulte']['nom_utilisateur'],$this->data['InscrireAdulte']['mot_de_passe']);
            $this->redirect(array('controller' => 'information_generale', 'action' => 'index'));
        } elseif (array_key_exists('accueil', $this->params['form'])) {
            $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
        }
    }

    /**
     * Cette méthode permet de créer un compte membre pour le pilote du système
     * lors de l'installation de celui-ci.
     * @author Frédérik Paradis
     */
    public function installation() {
        if($this->_isInstallationEffecutee()) {
            $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
        }
        
        $this->layout = 'aucun_menu';
        $this->set('title_for_layout', __('Création d\'un compte pilote', true));
        $this->set('titre', __('Création d\'un compte pilote', true));
        $this->set('ariane', __('Installation > Création d\'un compte pilote', true));

        if ($this->_ajoutMembre()) {
            $conditions = array("Compte.nom_utilisateur" => $this->data['InscrireAdulte']['nom_utilisateur'],'Compte.mot_de_passe' => hash('sha256', $this->data['InscrireAdulte']['mot_de_passe']));
            $resultat = $this->Compte->find('first', array('conditions' => $conditions,'fields' => 'Compte.id'));
            $this->AutorisationsCompte->create();
            $this->AutorisationsCompte->save(array('autorisation_id' => 4, 'compte_id' => $resultat['Compte']['id']));
            $this->Session->write("authentification", $this->validerInformation->validerInformation(
                    $this->data['InscrireAdulte']['nom_utilisateur'], 
                    $this->data['InscrireAdulte']['mot_de_passe']
                    )
            );
            file_put_contents('../installation_effectuee.txt', '1', FILE_USE_INCLUDE_PATH);
            $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
        }
    }

	/*
         * Cette méthode vérifie quel bouton a été cliqué et exécute la bonne action.
         * Si le bouton annuler a été cliquer on valide les champs et on renvoit vers l'accueil
         * Si le bouton mettre à jour a été cliqué et fait l'enregistrement des modifications
         */

        private function _navigation() {

                //Si le bouton suivant est cliqué
                if (array_key_exists('annuler', $this->params['form'])) {
                     $this->redirect(array('controller' => 'connexion', 'action' => 'index'));
                        
                } elseif (array_key_exists('valider', $this->params['form'])) {
                    //enregistrement des membres
					if ($this->_ajoutMembre()) {
						$this->Session->write("authentification", $this->validerInformation->validerInformation(
								$this->data['InscrireAdulte']['nom_utilisateur'], 
								$this->data['InscrireAdulte']['mot_de_passe']
								)
						);
						$this->redirect(array('action' => 'view'));
                }
        }
	}
	
	
	
    /**
     * Initilise la liste des implications par rapport à celle dans la base de données
     * @author Luc-Frédéric Langis
     */
    private function _initImplication() {

        //Cherche les implications dans la base de données
        $implication = $this->Implication->find('all');

        //Initialisation
        $option = array();
        foreach ($implication as $valeur) {
            $option[$valeur['Implication']['id']] = $valeur['Implication']['nom'];
        }

        return $option;
    }

    /**
     * Créer une session après l'inscription
     * @author Michel Biron
     */
    private function _creerSession() {

        $resultat = $this->Compte->find('first', array('conditions' => $conditions, 'fields' => 'Compte.id'));

        if (!empty($resultat)) {
            $resultat = array('autorisation' => $resultat['Autorisation'], 'id_compte' => $resultat['Compte']['id'], 'id_adulte' => $resultat['Adulte']['0']['id']);
        }
    }

    /**
     * Enregistrement de membre dans la base de données
     * @return void
     * @author Luc-Frédéric Langis
     */
    private function _ajoutMembre() {
        $retour = false;
        if (!empty($this->data)) {
            //Si le compte existe déjà
            $compteExistant = $this->Compte->find('first', array('conditions' => array('Compte.nom_utilisateur' => $this->data['InscrireAdulte']['nom_utilisateur'])));

            $this->InscrireAdulte->set($this->data);
            if ($this->InscrireAdulte->validates() && (empty($compteExistant))) {
                //Créer les intances de la bd nécessaire
                $this->Compte->create();
                $this->Adulte->create();
                //Enregistrement des données dans la base de données
                if ($this->Compte->save(array('nom_utilisateur' => $this->data['InscrireAdulte']['nom_utilisateur'],
                            'mot_de_passe' => hash('sha256', $this->data['InscrireAdulte']['mot_de_passe']))) &&
                        ($this->Adulte->save(array('prenom' => $this->data['InscrireAdulte']['prenom'],
                            'nom' => $this->data['InscrireAdulte']['nom'],
                            'tel_maison' => $this->data['InscrireAdulte']['tel_maison'],
                            'sexe' => $this->data['InscrireAdulte']['sexe'],
                            'tel_bureau' => $this->data['InscrireAdulte']['tel_bureau'],
                            'poste_bureau' => $this->data['InscrireAdulte']['poste_bureau'],
                            'profession' => $this->data['InscrireAdulte']['profession'],
                            'courriel' => $this->data['InscrireAdulte']['nom_utilisateur'],
                            'compte_id' => $this->Compte->id,
                            'tel_autre' => $this->data['InscrireAdulte']['tel_autre'])))) {

                    //Si une implication est existante
                    if ((isset($this->data['InscrireAdulte']['Implication'])) && (!empty($this->data['InscrireAdulte']['Implication']))) {

                        foreach ($this->data['InscrireAdulte']['Implication'] as $impl) {
                            $this->AdultesImplication->create();
                            $this->AdultesImplication->save(array('implication_id' => $impl, 'adulte_id' => $this->Adulte->id));
                        }
                    }
                    //Si l'enregistrement a bien été fait, affiche le bon messasge
                    $this->Session->setFlash(__('Inscription terminée', true));
                    $retour = true;
                } else {
                    $this->Session->setFlash(__('Oups, petite erreur, veuillez ressayer plus tard', true));
                }
                //Si l'enregistrement a bien été fait, affiche le bon message
                $this->Session->setFlash(__('Inscription terminée', true));
            } else {
                $this->Session->setFlash(__('Oups, petite erreur, veuillez ressayer plus tard', true));
                //L'erreur ne peut être géré par le modèle, donc elle est faite manuellement
                if (!empty($compteExistant)) {
                    $erreur = '<font color="white"> &nbsp; L\'adresse courriel est déjà utilisée</font></div>';
                    $this->set('erreurCompte', $erreur);
                }
            }
        }

        return $retour;
    }

}

?>
