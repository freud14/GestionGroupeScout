
<?php

class ModifierFicheMedController extends AppController {

        var $helpers = array('Html', 'Javascript', 'Form');
        var $name = 'ModifierFicheMed';

        function beforeFilter() {
                parent::beforeFilter();
                $this->layout = 'parent';
                $this->loadModel("Maladie");
                $this->loadModel('Medicament');
                $this->loadModel('Enfant');
                $this->loadModel('Adulte');
                $this->loadModel('Prescription');   
                $this->loadModel('FicheMedicale');
                $this->loadModel('FicheMedicalesMalady');
                $this->loadModel('FicheMedicalesMedicament');           
                $this->loadModel('QuestionGenerale');
                $this->loadModel('FicheMedicalesQuestionGenerale');
        }
        /**
         *Cette fonction vérifie si un enfant est l'enfant d'un adulte
         * @param int $id_enfant l'id de l'enfant
         * @param int $id_parent l'id de l'adulte
         * @return boolean vrai si l'adulte est le parent de l'enfant sinon faux
         */
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

    /**
     *La fonction permet de visualiser et de modifier la fiche médicale d'un enfant
     * @param int $id_enfant le id de l'enfant dont on désire voir la fiche médicale
     */
        public function index($id_enfant) {

             
                $id_adulte = $this->Session->read('authentification.id_adulte');
                $id_fiche_medicale = $this->Enfant->find('first', array('conditions' => array('Enfant.id' => $id_enfant)));
                $id_fiche_medicale = $id_fiche_medicale['FicheMedicale'][0]['id'];

                $monAutorisaion = $this->_getAutorisation();
                $modification = true;

                //on vérifie si le compte a les droits de parent sur l'enfant
                if ($this->_verifireEnfant($id_enfant, $id_adulte)) {
                        
                        if (array_key_exists('modifier', $this->params['form'])) {
                                $modification = false;
                        } elseif (array_key_exists('enregistrer', $this->params['form'])) {
                                //TODO Mettre les validations
                                $this->_updateFicheMed($id_fiche_medicale);
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
        /**
         *Permet de mettre a jour la fiche médicale d'un enfant
         * @param int $id_fiche_medicale l'id de la fiche médicale que l'on souhaite modifier
         */
        private function _updateFicheMed($id_fiche_medicale) {
								
                $modification = $this->data;
                $modification = $modification['ModifierFicheMed'];


                //met la fiche medicale a jour
                $this->FicheMedicale->save(array('id' => $id_fiche_medicale,
                    'allergie' => $modification['allergie'],
                    'phobie' => $modification['peur']));

                //met la table prescription a jour
                $this->Prescription->deleteAll(array('fiche_medicale_id' => $id_fiche_medicale));
                if (!empty($modification['prescription'])) {
              
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
        /**
         *retourne la liste des maladies
         * @return array la liste des maladies
         */
        public function getMaladieListe() {
                return $this->Maladie->find('all');
        }
        /**
         *Retourne la liste des question
         * @return array liste des question
         */
        public function getQuestionListe() {
                return $this->QuestionGenerale->find('all');
        }
        /**
         * retourne la liste des medicaments
         * @return array la liste des medicaments
         */
        public function getMedicamentListe() {
                return $this->Medicament->find('all');
        }

}

?>
