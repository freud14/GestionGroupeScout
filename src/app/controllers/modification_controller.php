
<?php

class ModificationController extends AppController {

        var $helpers = array('Html', 'Javascript', 'Form');
        var $name = 'Modification';
        var $components = array('supprimer');

        function beforeFilter() {
                parent::beforeFilter();
                $this->layout = 'parent';
                $this->loadModel("Maladie");
                $this->loadModel('Medicament');


                $this->loadModel('Enfant');
                $this->loadModel('Adulte');
                $this->loadModel('Adresse');
                $this->loadModel('AdultesEnfant');
                $this->loadModel('Inscription');
                $this->loadModel('Prescription');
                $this->loadModel('ContactUrgence');
                $this->loadModel('FicheMedicale');
                $this->loadModel('FicheMedicalesMalady');
                $this->loadModel('FicheMedicalesMedicament');
                $this->loadModel('InformationScolaire');
                $this->loadModel('QuestionGenerale');
                $this->loadModel('FicheMedicalesQuestionGenerale');
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



                $this->set('id_enfant', $id_enfant);
                $this->set('session', $informationGenerale);
                $this->set('modification', true);
        }

        public function ficheMedicale($id_enfant) {
                $modification = $this->data;
                $modification = $modification['Modification'];
                pr($modification);
                $antecedant = array_merge((array) $modification['antecedent1'], (array) $modification['antecedent2'], (array) $modification['antecedent3']);
                pr($antecedant);
                $id_adulte = $this->Session->read('authentification.id_compte');
                $id_fiche_medicale = $this->Enfant->find('first', array('conditions' => array('Enfant.id' => $id_enfant)));
                $id_fiche_medicale = $id_fiche_medicale['FicheMedicale'][0]['id'];
                //$this->_updateFicheMed($id_fiche_medicale);
                $monAutorisaion = $this->_getAutorisation();
                $modification = true;
                if (array_key_exists('modifier', $this->params['form'])) {

                        if (($monAutorisaion > 2) || ($this->_verifireEnfant($id_enfant, $id_adulte))) {

                                $modification = false;
                        }
                } elseif (array_key_exists('enregistrer', $this->params['form'])) {
                        //TODO Mettre les validations
                        $this->_updateFicheMed($id_enfant);
                }
                /*




                  }

                  //Cherche le total des questions
                  $question = $this->QuestionGenerale->find('all');
                  //Pour chercher dans la session avec l'index
                  $question_array = $this->Session->read('fiche_med.InscriptionFicheMed');

                  foreach ($question as $value) {
                  //Si le question est vrai
                  if ($question_array['q' . $value['QuestionGenerale']['id']] == 'O') {
                  $this->FicheMedicalesQuestionGenerale->create();
                  $this->FicheMedicalesQuestionGenerale->save(array('question_generale_id' => $value['QuestionGenerale']['id'],
                  'fiche_medicale_id' => $this->FicheMedicale->id));
                  }
                  }
                 */
                $this->set('title_for_layout', __('Fiche médicale', true));
                $this->set('titre', __('Fiche médicale', true));


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

                $listeQuestion = $this->getQuestionListe();
                $reponseQuestion = array();

                foreach ($listeQuestion as $question) {
                        $reponseQuestion[$question['QuestionGenerale']['id']] = 'N';
                }

                foreach ($ficheMed['QuestionGenerale'] as $question) {
                        $reponseQuetruestion[$question['id']] = 'O';
                }
                $this->set('id_enfant', $id_enfant);
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

        private function _updateFicheMed($id_fiche_medicale) {

                $modification = $this->data;
                $modification = $modification['Modification'];
                pr($modification);

                //met la fiche medicale a jour
                $this->FicheMedicale->save(array('id' => $id_fiche_medicale,
                    'allergie' => $modification['allergie'],
                    'phobie' => $modification['peur']));

                //met la table prescription a jour
                $this->Prescription->deleteAll(array('fiche_medicale_id' => $id_fiche_medicale));
                if (!empty($prescription)) {
                        $this->Prescription->create();
                        $this->Prescription->save(array('posologie' => $modification['prescription']));
                }

                //met a jour les occurence de fiche_medicale_maladie
                //combine les tableaux d'antécédant

                $antecedant = array_merge((array) $modification['antecedent1'], (array) $modification['antecedent2'], (array) $modification['antecedent3']);

                $this->FicheMedicalesMalady->deleteAll(array('fiche_medicale_id' => $id_fiche_medicale));

                foreach ($antecedant as $occurence) {
                        if (!empty($occurence)) {
                                $this->FicheMedicalesMalady->create();
                                $this->FicheMedicalesMalady->save(array('fiche_medicale_id' => $this->FicheMedicale->id,
                                    'maladie_id' => $occurence));
                        }
                }

                //met a jour les medicaments autorisés
                $this->FicheMedicalesMedicament->deleteAll(array('fiche_medicale_id' => $id_fiche_medicale));

                foreach ($modification['medicamentautoriseLab'] as $medicament) {
                        if ($medicament != '') {
                                $this->FicheMedicalesMedicament->create();
                                $this->FicheMedicalesMedicament->save(array('medicament_id' => $medicament, 'fiche_medicale_id' => $id_fiche_medicale));
                        }
                }
                
                //met a jour les questions dans l'index
                $this->FicheMedicalesQuestionGenerale->deleteAll(array('fiche_medicale_id' => $id_fiche_medicale));
                
                $question = $this->QuestionGenerale->find('all');
                
                $question_array = $modification;

                foreach ($question as $value) {
                        //Si le question est vrai
                        if ($question_array['q' . $value['QuestionGenerale']['id']] == 'O') {
                                $this->FicheMedicalesQuestionGenerale->create();
                                $this->FicheMedicalesQuestionGenerale->save(array('question_generale_id' => $value['QuestionGenerale']['id'],
                                    'fiche_medicale_id' => $this->FicheMedicale->id));
                        }
                }
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
