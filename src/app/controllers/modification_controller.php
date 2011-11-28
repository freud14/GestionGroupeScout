
<?php

class ModificationController extends AppController {

        var $helpers = array('Html', 'Javascript', 'Form');
        var $name = 'Modification';

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

        private function _updateInfoGen($id_enfant) {
                $modification = $this->data;
                $modification = $modification['Modification'];
                // $this->Adresse->deleteAll(array('Enfant.id_enfant' => $id_enfant));
                $enfant = $this->Enfant->find('first', array('conditions' => array('Enfant.id' => $id_enfant)));
                pr($enfant);
                $this->Adresse->save(array('id' => $enfant['Enfant']['id'],
                    'adresses' => $modification['adresse'],
                    'ville' => $modification['ville'],
                    'code_postal' => $modification['code_postal']));
                if (!empty($enfant['Adulte'][1]['id'])) {
                        if (empty($modification['nom_tuteur'])) {
 //$this->AdultesEnfant->deleteAll(array('adulte_id' => $enfant['Adulte'][1]['id'], 'enfant_id' => $id_enfant));
 /* $this->Adulte->save(array('id' => $enfant['Adulte'][1]['id'],'nom' => $modification['nom_tuteur'],
 'prenom' => $modification['prenom_tuteur'], 'tel_maison' => $modification['telephone_maison_tuteur'],
'tel_bureau' => $modification['telephone_bureau_tuteur'],'poste_bureau' =>$modification['telephone_bureau_tuteur'],
                                 */ $this->Adulte->save(array('adulte_id' => $enfant['Adulte'][1]['id'],
                                'nom' => $modification['nom_tuteur'],
                                'prenom' => $modification['prenom_tuteur'],
                                'sexe' => $this->Session->read('info_gen.InformationGenerale.sexe_tuteur'),
                               'tel_maison' => $modification['telephone_maison_tuteur'],
                                'tel_bureau' => $modification['telephone_bureau_tuteur'],
                                'poste_bureau' =>$modification['telephone_bureau_tuteur'],
                                'tel_autre' => $modification['cellulaire_tuteur'],
                                'sexe' => $modification['sexe_tuteur'],
                                'profession' => $modification['emploi_tuteur']));
                                
                        }
                }


                /* $this->AdultesEnfant->save(array('adulte_id' => $this->Session->read('authentification.id_adulte'),
                  'enfant_id' => $this->Enfant->id));
                  )/* &&
                  ($this->Inscription->save(array('enfant_id' => $this->Enfant->id,
                  'groupe_age_id' => $this->Session->read('info_gen.InformationGenerale.groupe_age'),
                  'date_inscription' => DboSource::expression('NOW()'),
                  'annee_id' => $annee['Annee']['id'],
                  'autorisation_photo' => $photo,
                  'autorisation_baignade' => $baignade)))
                 * ========================================================
                 * if (($this->Adresse->save(array('adresses' => $this->Session->read('info_gen.InformationGenerale.adresse'),
                  'ville' => $this->Session->read('info_gen.InformationGenerale.ville'),
                  'code_postal' => $this->Session->read('info_gen.InformationGenerale.code_postal')))) &&
                  ($this->Enfant->save(array('nom' => $this->Session->read('info_gen.InformationGenerale.nom'),
                  'prenom' => $this->Session->read('info_gen.InformationGenerale.prenom'),
                  'date_naissance' => date('Y-m-d', (strtotime(
                  $this->Session->read('info_gen.InformationGenerale.date_de_naissance.year') .
                  $this->Session->read('info_gen.InformationGenerale.date_de_naissance.month') .
                  $this->Session->read('info_gen.InformationGenerale.date_de_naissance.day')
                  ))),
                  'adresse_id' => $this->Adresse->id,
                  'no_ass_maladie' => $this->Session->read('info_gen.InformationGenerale.assurance_maladie'),
                  'sexe' => $this->Session->read('info_gen.InformationGenerale.sexe'),
                  'particularite_jeunes' => $this->Session->read('info_gen.InformationGenerale.particularite')))) &&
                  ($this->AdultesEnfant->save(array('adulte_id' => $this->Session->read('authentification.id_adulte'),
                  'enfant_id' => $this->Enfant->id))) &&
                  ($this->Inscription->save(array('enfant_id' => $this->Enfant->id,
                  'groupe_age_id' => $this->Session->read('info_gen.InformationGenerale.groupe_age'),
                  'date_inscription' => DboSource::expression('NOW()'),
                  'annee_id' => $annee['Annee']['id'],
                  'autorisation_photo' => $photo,
                  'autorisation_baignade' => $baignade))) &&
                 * ==========================================================
                 * if (!empty($tuteur)) {
                  $this->Adulte->create();
                  $this->AdultesEnfant->create();

                  $this->Adulte->save(array('nom' => $this->Session->read('info_gen.InformationGenerale.nom_tuteur'),
                  'prenom' => $this->Session->read('info_gen.InformationGenerale.prenom_tuteur'),
                  'sexe' => $this->Session->read('info_gen.InformationGenerale.sexe_tuteur'),
                  'tel_maison' => $this->Session->read('info_gen.InformationGenerale.telephone_maison_tuteur'),
                  'tel_bureau' => $this->Session->read('info_gen.InformationGenerale.telephone_bureau_tuteur'),
                  'tel_bureau_poste' => $this->Session->read('info_gen.InformationGenerale.telephone_bureau_poste_tuteur'),
                  'tel_autre' => $this->Session->read('info_gen.InformationGenerale.cellulaire_tuteur'),
                  'sexe' => $this->Session->read('info_gen.InformationGenerale.sexe_tuteur'),
                  'profession' => $this->Session->read('info_gen.InformationGenerale.profession')));

                  $this->AdultesEnfant->save(array('adulte_id' => $this->Adulte->id,
                  'enfant_id' => $this->Enfant->id));
                  }
                  =======================================================================
                 * 
                 */
                $this->Enfant->save(array('id' => $id_enfant,
                    'nom' => $modification['nom'],
                    'prenom' => $modification['prenom'],
                    'date_naissance' => date('Y-m-d', (strtotime($modification['date_de_naissance']['year'] . $modification['date_de_naissance']['month'] . $modification['date_de_naissance']['day']
                            ))), 'no_ass_maladie' => $modification['assurance_maladie'],
                    'sexe' => $modification['sexe'],
                    'particularite_jeunes' => $modification['particularite']));
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
                pr($this->data);

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
