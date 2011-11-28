
<?php

class ModificationController extends AppController {

        var $helpers = array('Html', 'Javascript', 'Form');
        var $name = 'Modification';
        var $components = array('supprimer');

        function beforeFilter() {
                parent::beforeFilter();
                $this->layout = 'parent';
                $this->loadModel("Maladie");
                $this->loadModel('QuestionGenerale');
                $this->loadModel('Medicament');
                $this->loadModel('FicheMedicale');
                $this->loadModel('Adulte');
                $this->loadModel('Enfant');
        }

        private function _verifireEnfant($id_enfant, $id_parent) {
                $adulte = $this->Adulte->find('first', array('conditions' => array('Adulte.id' => $id_parent)));
                $valeur = false;
                foreach ($adulte['Enfant'] as $enfant) {
                        if ($enfant['id'] == $id_enfant) {
                                $valeur = true;
                        }
                }
                return $valeur;
        }

        public function informationGenerale($id_enfant) {
                //si la page ne c'est pas rapeler elle même
                $modification = true;
                if (array_key_exists('modifier', $this->params['form'])) {

                        if (($monAutorisaion > 2) || ($this->_verifireEnfant($id_enfant, $id_adulte))) {

                                $modification = false;
                        }
                }
                $enfant = $this->Enfant->find('first', array('conditions' => array('Enfant.id' => $id_enfant)));
                // pr($enfant);
                //   $this->_navigation();
                pr($enfant);
                $informationGenerale = array('nom' => $enfant['Enfant']['nom'],
                    'prenom' => $enfant['Enfant']['prenom'],
                    'sexe' => $enfant['Enfant']['sexe'],
                    'date_de_naissance' => array('day' => "", 'month' => "", 'year' => ""),
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
                        //   pr($contact);
                        $informationGenerale['nom_urgence'] = $contact['Adulte']['nom'];
                        $informationGenerale['prenom_urgence'] = $contact['Adulte']['prenom'];
                        $informationGenerale['telephone_principal_urgence'] = $contact['Adulte']['tel_maison'];
                }
                if (empty($enfant)) {
                        
                }
                pr($informationGenerale);

                /*
                 *  Les champs du tuteur qu'il faut assigner
                  'nom_tuteur' => "",
                  'prenom_tuteur' => "",
                  'sexe_tuteur' => "",
                  'courriel_tuteur' => "",
                  'telephone_maison_tuteur' => "",
                  'telephone_bureau_tuteur' => "",
                  'telephone_bureau_poste_tuteur' => "",
                  'cellulaire_tuteur' => "",
                  'emploi_tuteur' => "", */

                $this->set('title_for_layout', __('Informations générales', true));
                $this->set('titre', __('Informations générales', true));


                $informationGenerale = array();
                // $this->set('groupe_age', $this->GroupeAge->find('all'));
                //pr($informationGenerale);
                //pr($informationGenerale);
                $this->set('id_enfant', $id_enfant);
                $this->set('session', $informationGenerale);
                $this->set('modification', false);
        }

        public function ficheMedicale($id_enfant) {
                pr($this->params);
                $id_adulte = $this->Session->read('authentification.id_compte');
                $id_fiche_medicale = $this->Enfant->find('first', array('conditions' => array('Enfant.id' => $id_enfant)));
                $id_fiche_medicale = $id_fiche_medicale['FicheMedicale'][0]['id'];

                $monAutorisaion = $this->_getAutorisation();
                $modification = true;
                if (array_key_exists('modifier', $this->params['form'])) {

                        if (($monAutorisaion > 2) || ($this->_verifireEnfant($id_enfant, $id_adulte))) {

                                $modification = false;
                        }
                }

                $this->set('title_for_layout', __('Fiche médicale', true));
                $this->set('titre', __('Fiche médicale', true));


                // pr($session);
                //pr($this->getMaladieListe());
                $ficheMed = $this->FicheMedicale->find('first', array('conditions' => array('FicheMedicale.id' => $id_fiche_medicale)));
                $antecedent = array();
                //  pr($ficheMed);
                foreach ($ficheMed['Maladie'] as $maladie) {
                        $antecedent [] = $maladie['id'];
                }
                $medicaments = array();
                foreach ($ficheMed['Medicament'] as $med) {
                        $medicaments[] = $med['id'];
                }
                $prescriptions = "";
                if (!empty($ficheMed['Prescription'])) {
                        $prescriptions = $ficheMed['Prescription'][0]['posologie'];
                }
                //pr($antecedent);
                $listeQuestion = $this->getQuestionListe();
                $reponseQuestion = array();

                foreach ($listeQuestion as $question) {
                        $reponseQuestion[$question['QuestionGenerale']['id']] = 'N';
                }

                foreach ($ficheMed['QuestionGenerale'] as $question) {
                        $reponseQuetruestion[$question['id']] = 'O';
                }

                $this->set('modification', $modification);
                $this->set('reponseQuestion', $reponseQuestion);
                $this->set('antecedents', $antecedent);
                $this->set('resultmedicaments', $medicaments);
                $this->set('peurs', $ficheMed['FicheMedicale']['phobie']);
                $this->set('allergies', $ficheMed['FicheMedicale']['allergie']);
                $this->set('prescriptions', $prescriptions);
                $this->set('no_fiche_medicale', $id_fiche_medicale);
                $this->set('maladies', $this->getMaladieListe());
                $this->set('questions', $listeQuestion);
                $this->set('medicaments', $this->getMedicamentListe());
        }

        public function getMaladieListe() {
                return $this->Maladie->find('all');
        }

        public function getQuestionListe() {
                return $this->QuestionGenerale->find('all');
        }

        public function getMedicamentListe() {
                return $this->Medicament->find('all');
        }

}
?>
