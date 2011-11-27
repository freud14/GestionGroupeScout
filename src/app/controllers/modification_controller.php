
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

        public function fiche_medicale($id_enfant) {
                $id_adulte = $this->Session->read('authentification.id_compte');
                $id_fiche_medicale = $this->Enfant->find('first', array('conditions' => array('Enfant.id' => $id_enfant)));
                $id_fiche_medicale = $id_fiche_medicale['FicheMedicale'][0]['id'];
               
                $monAutorisaion = $this->_getAutorisation();
                $modification = true;
                if (array_key_exists('modifier', $this->params['form'])) {

                        if (($monAutorisaion > 2) || ($this->_verifireEnfant(1, $id_adulte))) {

                                $modification = false;
                        }
                }
                $id_fiche_medicale = 1;
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
                $this->set('no_fiche_medicale',$id_fiche_medicale);
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

/*
  class InscriptionFicheMedController extends AppController {

  var $helpers = array('Html', 'Javascript', 'Form');
  var $name = 'InscriptionFicheMed';





  /*
 * La fonction _navigation vérifie quel bouton a été cliqué et execute la bonne action
 */
/*
  private function _navigation() {



  //si le bouton précédent est cliqué
  if (array_key_exists('precedent', $this->params['form'])) {
  $this->redirect(array('controller' => 'information_generale', 'action' => 'index'));
  //si le bouton suivant est cliqué
  } elseif (array_key_exists('suivant', $this->params['form'])) {

  $this->redirect(array('controller' => 'inscription_autorisation', 'action' => 'index'));
  } elseif (array_key_exists('annuler', $this->params['form'])) {
  $this->supprimer->supprimerInscription($this);
  $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
  }
  }

  public function index() {
  // pr($this->data);
  //Si ce n'est pas la page qui renvoit vers elle même
  if (empty($this->data)) {/*
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
  $session = $this->Session->read('fiche_med.InscriptionFicheMed');
  //s'il n'y a pas d'information déjà existante
  if (empty($session)) {

  $session = array('antecedent1' => array(),
  'antecedent2' => array(),
  'antecedent3' => array(),
  'q1' => "",
  'q2' => "",
  'medicamentautoriseLab' => array(),
  'prescription' => "",
  'allergie' => "",
  'peur' => ""
  );
  }
  //c'est la page elle même qui s'apelle
  } else {

  $this->Session->write("fiche_med", $this->params['data']);
  //$this -> Session -> write("url", $this->params['url']);
  $this->_navigation();
  $session = $this->Session->read('fiche_med.InscriptionFicheMed');
  }



  //on format les informations contenues dans la variable session
  $antecedent = array();
  $medicaments = array();

  $buffer = array_merge((array) $session['antecedent1'], (array) $session['antecedent2'], (array) $session['antecedent3']);

  if (!empty($buffer)) {
  foreach ($buffer as $valeur) {
  $antecedent[] = $valeur;
  }
  }
  $reponseQuestion = array();
  foreach ($session as $cle => $valeur) {

  if ($cle[0] == 'q') {

  $reponseQuestion[substr($cle, 1)] = $valeur;
  }
  }
  if (!empty($session['medicamentautoriseLab'])) {
  foreach ($session['medicamentautoriseLab'] as $valeur) {

  $medicaments[] = $valeur;
  }
  }
  //pr($reponseQuestion);

  $this->set('title_for_layout', __('Inscription d\'un enfant', true));
  $this->set('titre', __('Fiche médicale', true));
  $this->set('ariane', __('Informations générales > <span style="color: green;">Fiches médicales</span> > Autorisations', true));

  //on rend les informations contenues dans la variablle session accessible dans la vue


  pr($antecedent);
  }

  } */
?>