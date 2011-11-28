
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
                $id_adulte = $this->Session->read('authentification.id_compte');
                if ($this->_verifireEnfant($id_enfant, $id_adulte)) {

                        if (array_key_exists('modifier', $this->params['form'])) {
                                $modification = false;
                        } elseif (array_key_exists('enregistrer', $this->params['form'])) {
                                //TODO Mettre les validations
                                $this->_updateInfoGen($id_enfant);
                        } elseif (array_key_exists('annuler', $this->params['form'])) {
                               // $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
                        }
                } else {
                      //  $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
                }
                
                $enfant = $this->Enfant->find('first', array('conditions' => array('Enfant.id' => $id_enfant)));
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
                //s'il y a un deuxieme parent
                pr($enfant['Adulte'][1]);
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

        public function ficheMedicale($id_enfant) {

                pr($this->data);
                $id_adulte = $this->Session->read('authentification.id_compte');
                $id_fiche_medicale = $this->Enfant->find('first', array('conditions' => array('Enfant.id' => $id_enfant)));
                $id_fiche_medicale = $id_fiche_medicale['FicheMedicale'][0]['id'];

                $monAutorisaion = $this->_getAutorisation();
                $modification = true;


                if ($this->_verifireEnfant($id_enfant, $id_adulte)) {

                        if (array_key_exists('modifier', $this->params['form'])) {
                                $modification = false;
                        } elseif (array_key_exists('enregistrer', $this->params['form'])) {
                                //TODO Mettre les validations
                                $this->_updateFicheMed($id_enfant);
                        } elseif (array_key_exists('annuler', $this->params['form'])) {
                                $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
                        }
                } else {
                        $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
                }

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
                        $reponseQuestion[$question['id']] = 'O';
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


                //met la fiche medicale a jour
                $this->FicheMedicale->save(array('id' => $id_fiche_medicale,
                    'allergie' => $modification['allergie'],
                    'phobie' => $modification['peur']));

                //met la table prescription a jour
                $this->Prescription->deleteAll(array('fiche_medicale_id' => $id_fiche_medicale));
                if (!empty($modification['prescription'])) {
                        pr($modification['prescription']);
                        pr('chaussure');
                        $this->Prescription->create();
                        $this->Prescription->save(array('fiche_medicale_id' => $id_fiche_medicale, 'posologie' => $modification['prescription']));
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
