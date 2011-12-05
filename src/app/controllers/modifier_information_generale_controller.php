
<?php

class ModifierInformationGeneraleController extends AppController {

    var $helpers = array('Html', 'Javascript', 'Form');
    var $name = 'ModifierInformationGenerale';

    function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'parent';
        $this->loadModel('Enfant');
        $this->loadModel('Adulte');
        $this->loadModel('Adresse');
        $this->loadModel('AdultesEnfant');
        $this->loadModel('Prescription');
        $this->loadModel('ContactUrgence');
        $this->loadModel('InformationScolaire');
    }

    /**
     * Cette fonction vérifie si un enfant est l'enfant d'un adulte
     * @param int $id_enfant l'id de l'enfant
     * @param int $id_parent l'id de l'adulte
     * @return boolean vrai si l'adulte est le parent de l'enfant sinon faux
     */
    private function _verifierEnfant($id_enfant, $id_parent) {
	
        $adulte = $this->Adulte->find('first', array('conditions' => array('Adulte.id' => $id_parent)));
        $valeur = false;
        foreach ($adulte['Enfant'] as $enfant) {
            if ($enfant['id'] == $id_enfant) {
                $valeur = true;
            }
			
        }
        return $valeur;
    }

    /**
     * Met a jour les information générales d'un enfant
     * @param int $id_enfant l'id de l'enfant que l'on souhaite modifier
     */
    private function _updateInfoGen($id_enfant) {
        $modification = $this->data;
        $modification = $modification['ModifierInformationGenerale'];

        $enfant = $this->Enfant->find('first', array('conditions' => array('Enfant.id' => $id_enfant)));

        $this->Adresse->save(array('id' => $enfant['Enfant']['adresse_id'],
            'adresses' => $modification['adresse'],
            'ville' => $modification['ville'],
            'code_postal' => $modification['code_postal']));

        if (!empty($modification['nom_tuteur'])) {

            if (empty($enfant['Adulte'][1]['id'])) {
                $enfant['Adulte'][1]['id'] = null;
            }
            //on crée/actualise l'autre adulte
            $this->Adulte->save(array('id' => $enfant['Adulte'][1]['id'],
                'nom' => $modification['nom_tuteur'],
                'prenom' => $modification['prenom_tuteur'],
                'courriel' => $modification['courriel_tuteur'],
                'tel_maison' => $modification['telephone_maison_tuteur'],
                'tel_bureau' => $modification['telephone_bureau_tuteur'],
                'poste_bureau' => $modification['telephone_bureau_tuteur'],
                'tel_autre' => $modification['cellulaire_tuteur'],
                'sexe' => $modification['sexe_tuteur'],
                'profession' => $modification['emploi_tuteur']));

            //Si l'autre parent n'existait pas deja on le lie avec l'enfant
            if (empty($enfant['Adulte'][1]['id'])) {
                $this->AdultesEnfant->save(array('adulte_id' => $this->Adulte->id, 'enfant_id' => $id_enfant));
            }
            //Si les information du tuteur sont vide
        } else {
            //s'il y a un autre parent on le supprime.
            if (!empty($enfant['Adulte'][1]['id'])) {

                $this->AdultesEnfant->deleteAll(array('adulte_id' => $this->Adulte->id, 'enfant_id' => $id_enfant));
                $this->Adulte->deletaAll(array('id' => $enfant['Adulte'][1]['id']));
            }
        }
        //on enregistre les modifications au contact d'urgence

        $this->Adulte->save(array('id' => $enfant['ContactUrgence'][0]['adulte_id'],
            'nom' => $modification['nom_urgence'],
            'prenom' => $modification['prenom_urgence'],
            'tel_maison' => $modification['telephone_principal_urgence']));
        $this->ContactUrgence->save(array('id' => $enfant['ContactUrgence'][0]['id'],
            'lien' => $modification['lien_jeune_urgence']
        ));

        //on enregistre les modifications au informations scolaires
        $this->InformationScolaire->save(array('id' => $enfant['InformationScolaire'][0]['id'],
            'nom_ecole' => $modification['etab_scolaire'],
            'niveau_scolaire' => $modification['niveau_scolaire'],
            'nom_enseignant' => $modification['enseignant']));

        //on enregistre les modifications de l'enfant
        $this->Enfant->save(array('id' => $id_enfant,
            'nom' => $modification['nom'],
            'prenom' => $modification['prenom'],
            'date_naissance' => date('Y-m-d', (strtotime($modification['date_de_naissance']['year'] . $modification['date_de_naissance']['month'] . $modification['date_de_naissance']['day']
                    ))), 'no_ass_maladie' => $modification['assurance_maladie'],
            'sexe' => $modification['sexe'],
            'particularite_jeunes' => $modification['particularite']));
    }

    /**
     * Affiche/Modifie les informations générales d'un enfant
     * @param int $id_enfant l'id de l'enfant que l'on désire consulter
     */
    public function index($id_enfant) {
        //si la page ne c'est pas rapeler elle même
        $modification = true;
        $id_adulte = $this->Session->read('authentification.id_adulte');
		//on vérifie si le compte a les droits de parent sur l'enfant
        if ($this->_verifierEnfant($id_enfant, $id_adulte)) {

            if (array_key_exists('modifier', $this->params['form'])) {
                $modification = false;
            } elseif (array_key_exists('enregistrer', $this->params['form'])) {
                //$this->ModifierInformationGenerale->set($this->data);
                
                //Si les champs sont bien remplis
                //if ($this->ModifierInformationGenerale->validates()) {
                    $this->_updateInfoGen($id_enfant);
                //}
            } elseif (array_key_exists('annuler', $this->params['form'])) {
                $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
            }
        } else {
          $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
        }


        $enfant = $this->Enfant->find('first', array('conditions' => array('Enfant.id' => $id_enfant)));

        $informationGenerale = array('nom' => $enfant['Enfant']['nom'],
            'prenom' => $enfant['Enfant']['prenom'],
            'sexe' => $enfant['Enfant']['sexe'],
            'date_de_naissance' => array('day' => substr($enfant['Enfant']['date_naissance'], 9, 10), 'month' => substr($enfant['Enfant']['date_naissance'], 6, 7), 'year' => substr($enfant['Enfant']['date_naissance'], 0, 4)),
            'assurance_maladie' => $enfant['Enfant']['no_ass_maladie'],
            'adresse' => $enfant['Adresse']['adresses'],
            'ville' => $enfant['Adresse']['ville'],
            'code_postal' => $enfant['Adresse']['code_postal'],
            'etab_scolaire' => $enfant['InformationScolaire'][0]['nom_ecole'],
            'niveau_scolaire' => $enfant['InformationScolaire'][0]['niveau_scolaire'],
            'enseignant' => $enfant['InformationScolaire'][0]['nom_enseignant'],
            'lien_jeune_urgence' => $enfant['ContactUrgence'][0]['lien'],
            'particularite' => $enfant['Enfant']['particularite_jeunes']
        );

        if (empty($enfant['ContactUrgence'])) {
            $informationGenerale['nom_urgence'] = "";
            $informationGenerale['prenom_urgence'] = "";
            $informationGenerale['telephone_principal_urgence'] = "";
        } else {
            $contact = $this->Adulte->find('first', array('recursive' => -1, 'conditions' => array('Adulte.id' => $enfant['ContactUrgence'][0]['adulte_id'])));
            $informationGenerale['nom_urgence'] = $contact['Adulte']['nom'];
            $informationGenerale['prenom_urgence'] = $contact['Adulte']['prenom'];
            $informationGenerale['telephone_principal_urgence'] = $contact['Adulte']['tel_maison'];
        }
        //s'il y a un deuxieme parent
        if (empty($enfant['Adulte'][1])) {

            $informationGenerale['nom_tuteur'] = '';
            $informationGenerale['prenom_tuteur'] = '';
            $informationGenerale['sexe_tuteur'] = '';
            $informationGenerale['courriel_tuteur'] = '';
            $informationGenerale['telephone_maison_tuteur'] = '';
            $informationGenerale['telephone_bureau_tuteur'] = '';
            $informationGenerale['telephone_bureau_poste_tuteur'] = '';
            $informationGenerale['cellulaire_tuteur'] = '';
            $informationGenerale['emploi_tuteur'] = '';
        } else {

            $tuteur = $enfant['Adulte'][1];
            $informationGenerale['nom_tuteur'] = $tuteur['nom'];
            $informationGenerale['prenom_tuteur'] = $tuteur['prenom'];
            $informationGenerale['sexe_tuteur'] = $tuteur['sexe'];
            $informationGenerale['courriel_tuteur'] = $tuteur['courriel'];
            $informationGenerale['telephone_maison_tuteur'] = $tuteur['tel_maison'];
            $informationGenerale['telephone_bureau_tuteur'] = $tuteur['tel_bureau'];
            $informationGenerale['telephone_bureau_poste_tuteur'] = $tuteur['poste_bureau'];
            $informationGenerale['cellulaire_tuteur'] = $tuteur['tel_autre'];
            $informationGenerale['emploi_tuteur'] = $tuteur['profession'];
        }


        $this->set('title_for_layout', __('Informations générales', true));
        $this->set('titre', __('Informations générales', true));
        $this->set('id_enfant', $id_enfant);
        $this->set('session', $informationGenerale);
        $this->set('modification', $modification);
    }

}

?>
