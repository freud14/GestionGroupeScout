<?php

/**
 * Modification du profil
 * @Author Luc-Frédéric Langis
 */
class ProfilController extends AppController {

    var $helpers = array('Html', 'Javascript', 'Form');
    var $name = 'Profil';
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

	/*
         * Cette méthode vérifie quel bouton a été cliqué et exécute la bonne action.
         * Si le bouton annuler a été cliquer on valide les champs et on renvoit vers l'accueil
         * Si le bouton mettre à jour a été cliqué et fait l'enregistrement des modifications
         */

        private function _navigation() {

                //Si le bouton suivant est cliqué
                if (array_key_exists('annuler', $this->params['form'])) {
                     $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
                        
                } elseif (array_key_exists('valider', $this->params['form'])) {
                   //Appel la mise à jour
					$this->_majMembre();
                }
        }
	
	
    /**
     * Permet à un membre de modifier ses informations personnelles
     * à l'aide de formulaire de profil
     * @Author Luc-Frédéric Langis
     */
    public function index() {

        $this->layout = 'parent';
        $this->set('titre', 'Mon profil');
        $this->set('ariane', __('<span style="color: green;"> Mon profil', true));
        $this->set('title_for_layout', __('Mon profil', true));

        //Initialise les checkboxs d'implications
        $this->set('option', $this->_initImplication());

		$this->_navigation();
		
        //Initialise le profil
		if(empty($this->data)){
			$profil = $this->Adulte->find('first', array('recursive' => 2,'conditions' => array('Adulte.compte_id' => $this->Session->read('authentification.id_compte'))));
			foreach($profil['Implication'] as $cle => $valeur){
				$option[$cle] = $valeur['AdultesImplication']['implication_id'];
			}
			
			$this->set('profil', $profil);
			if(!empty($option)){
				$this->set('implication', $option);
			}else{
				$this->set('implication', null);
			}
			
			
		} else {
			$profil = array();
			$profil['Compte']['nom_utilisateur'] = $this->data['Profil']['nom_utilisateur'];
			
			$profil['Adulte']['nom'] =  $this->data['Profil']['nom'];
			$profil['Adulte']['prenom'] = $this->data['Profil']['prenom'];
			$profil['Adulte']['tel_maison'] = $this->data['Profil']['tel_maison'];
			$profil['Adulte']['sexe'] = $this->data['Profil']['sexe'];
			$profil['Adulte']['tel_bureau'] = $this->data['Profil']['tel_bureau'];
			$profil['Adulte']['poste_bureau']= $this->data['Profil']['poste_bureau'];
			$profil['Adulte']['tel_autre'] = $this->data['Profil']['tel_autre'];
			$profil['Adulte']['profession'] = $this->data['Profil']['profession'];
			$this->set('profil', $profil);
			$this->set('implication', null);
		
     
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
     * Met à jour le profil de membre dans la base de données
     * @author Luc-Frédéric Langis
     * @see J'ai du faire deux fonctions pour la mise à jour et l'inscription, sinon cela occassionnais des conflits d'id et d'unicité
     */
    private function _majMembre() {

        //Si il change son adresse pour une existante
        $compteExistant = $this->Compte->find('first', array('conditions' => array('Compte.nom_utilisateur' => $this->data['Profil']['nom_utilisateur'])));
        $compteActuel = $this->Compte->find('first', array('conditions' => array('Compte.id' => $this->Session->read('authentification.id_compte'))));

		
        //Si le compte existe est celui actuel, on met le compteExistant à null
        if ($compteActuel['Compte']['nom_utilisateur'] == $compteExistant['Compte']['nom_utilisateur']) {
            $compteExistant = null;
        }

		
        if (!empty($this->data)) {
            $this->Profil->set($this->data);
            if ($this->Profil->validates() && (empty($compteExistant))) {
		
                //mémorise ses autorisations
                $autorisation = $this->AutorisationsCompte->find('first', array('conditions' => array('AutorisationsCompte.compte_id' => $this->Session->read('authentification.id_compte'))));
				
				pr($this->data);
                //Enregistrement des données dans la base de données, met à jour grâce à l'id
				if(!empty($this->data['Profil']['mot_de_passe'])){
					echo'non';
					$this->Compte->save(array('id' => $this->Session->read('authentification.id_compte'),
								'nom_utilisateur' => $this->data['Profil']['nom_utilisateur'],
								'mot_de_passe' => hash('sha256', $this->data['Profil']['mot_de_passe'])));
				}else{
				echo'oui';
					$this->Compte->save(array('id' => $this->Session->read('authentification.id_compte'),
								'nom_utilisateur' => $this->data['Profil']['nom_utilisateur']));
				}				
                if($this->Adulte->save(array('id' => $this->Session->read('authentification.id_adulte'),
                            'prenom' => $this->data['Profil']['prenom'],
                            'nom' => $this->data['Profil']['nom'],
                            'tel_maison' => $this->data['Profil']['tel_maison'],
                            'sexe' => $this->data['Profil']['sexe'],
                            'tel_bureau' => $this->data['Profil']['tel_bureau'],
                            'poste_bureau' => $this->data['Profil']['poste_bureau'],
                            'profession' => $this->data['Profil']['profession'],
                            'courriel' => $this->data['Profil']['nom_utilisateur'],
                            'compte_id' => $this->Session->read('authentification.id_compte'),
                            'tel_autre' => $this->data['Profil']['tel_autre']))) {


                    if (isset($autorisation)) {
                        $this->AutorisationsCompte->create();
                        $this->AutorisationsCompte->save(array('id' => $autorisation['AutorisationsCompte']['id'],
                            'autorisation_id' => $autorisation['AutorisationsCompte']['autorisation_id'],
                            'compte_id' => $autorisation['AutorisationsCompte']['compte_id']));
                    }

                    //Supprimer les implications avant pour éviter conflit
                    $this->AdultesImplication->deleteAll(array('adulte_id' => $this->Session->read('authentification.id_adulte')));
                    //Si une implication est existante
                    if ((isset($this->data['Profil']['Implication'])) && (!empty($this->data['Profil']['Implication']))) {
                        foreach ($this->data['Profil']['Implication'] as $impl) {
                            $this->AdultesImplication->create();
                            $this->AdultesImplication->save(array('implication_id' => $impl, 'adulte_id' => $this->Session->read('authentification.id_adulte')));
                        }
                    }
                    //Si l'enregistrement a bien été fait, affiche le bon messasge
                    $this->Session->setFlash(__('Inscription terminée', true));
                    $this->redirect(array('controller' => 'profil', 'action' => 'index'));
                 
				} 
			}else {
                //L'erreur ne peut être géré par le modèle, donc elle est faite manuellement
                if (!empty($compteExistant)) {
                    $erreur = '<font color="white"> &nbsp; L\'adresse courriel est déjà utilisée</font></div>';
                    $this->set('erreurCompte', $erreur);
                }
            }
        }
    }
}

?>
