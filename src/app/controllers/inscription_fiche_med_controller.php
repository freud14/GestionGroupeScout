<?php
/*
 * Permet de rentrer les informations médicales d'un enfant
 * @author Michel Biron
 */
class InscriptionFicheMedController extends AppController {

	var $helpers = array('Html', 'Javascript', 'Form');
	var $name = 'InscriptionFicheMed';

	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		$this->loadModel("Maladie");
		$this->loadModel('QuestionGenerale');
		$this->loadModel('Medicament');
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

	/*
	 * La fonction _navigation vérifie quel bouton a été cliqué et execute la bonne action
         * Si le bouton suivant a été cliqué on renvoit vers la page des autorisations
         * Si le bouton précédent a été cliqué on renvoit vers la page des informations générales
         * Si le bouton annuler a été cliqué on renvoit vers la d'accueil et
         *  supprime les informations dans la session
	 */

	private function _navigation() {



		//si le bouton précédent est cliqué
		if (array_key_exists('precedent', $this->params['form'])) {
			$this->redirect(array('controller' => 'information_generale', 'action' => 'index'));
			//si le bouton suivant est cliqué
		} elseif (array_key_exists('suivant', $this->params['form'])) {

			$this->redirect(array('controller' => 'inscription_autorisation', 'action' => 'index'));
		} elseif (array_key_exists('annuler', $this->params['form'])) {
			$this->Session->write('info_gen', null);
			$this->Session->write('fiche_med', null);
			$this->Session->write('InscriptionAutorisation', null);
			$this->redirect(array('controller' => 'accueil', 'action' => 'index'));
		}
	}
        /**
         * Permet d'entrer les informations de l'enfant
         */
	public function index() {
		$questions = $this->QuestionGenerale->find('all');

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
		  } */
			$session = $this->Session->read('fiche_med.InscriptionFicheMed');
			//s'il n'y a pas d'information déjà existante
			if (empty($session)) {

				$session = array('antecedent1' => array(),
					'antecedent2' => array(),
					'antecedent3' => array(),
					'medicamentautoriseLab' => array(),
					'prescription' => "",
					'allergie' => "",
					'peur' => ""
				);

				foreach ($questions as $value) {
					$session['q' . $value['QuestionGenerale']['id']] = '';
				}
			}
			//c'est la page elle même qui s'apelle
		} else {
			$this->Session->write("fiche_med", $this->data);
					$session = $this->Session->read('fiche_med.InscriptionFicheMed');
			$questionsRepondues = true;
			if (array_key_exists('suivant', $this->params['form'])) {
				$question_array = $this->data['InscriptionFicheMed'];
				foreach ($questions as $value) {
					if (!isset($question_array['q' . $value['QuestionGenerale']['id']]) ||
							$question_array['q' . $value['QuestionGenerale']['id']] == '') {
						$questionsRepondues = false;
						break;
					}
				}
			}


			if ($questionsRepondues) {
				$this->_navigation();
			} else {
				$this->set('erreur_questions_repondues', true);
			}
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
		$this->set('title_for_layout', __('Inscription d\'un enfant', true));
		$this->set('titre', __('Fiche médicale', true));
		$this->set('ariane', __('Informations générales > <span style="color: green;">Fiches médicales</span> > Autorisations', true));
		//on rend les informations contenues dans la variablle session accessible dans la vue
		$this->set('reponseQuestion', $reponseQuestion);
		$this->set('antecedents', $antecedent);
		$this->set('resultmedicaments', $medicaments);
		$this->set('peurs', $session['peur']);
		$this->set('allergies', $session['allergie']);
		$this->set('prescriptions', $session['prescription']);
		$this->set('maladies', $this->getMaladieListe());
		$this->set('questions', $this->getQuestionListe());
		$this->set('medicaments', $this->getMedicamentListe());
	}
}

?>
