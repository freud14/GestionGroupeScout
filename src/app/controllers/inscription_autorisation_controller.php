xx<?php

class InscriptionAutorisationController extends AppController {

	var $name = 'InscriptionAutorisation';
	var $helpers = array("Html", 'Form');

	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		$this->loadModel('Enfant');
		$this->loadModel('Adulte');
		$this->loadModel('Adresse');
		$this->loadModel('AdultesEnfant');
		$this->loadModel('Inscription');
		$this->loadModel('Prescription');
		$this->loadModel('ContactUrgence');
		$this->loadModel('Annee');
		$this->loadModel('FicheMedicale');
		$this->loadModel('FicheMedicalesMalady');
		$this->loadModel('FicheMedicalesMedicament');
		$this->loadModel('InformationScolaire');
		$this->loadModel('QuestionGenerale');
		$this->loadModel('FicheMedicalesQuestionGenerale');
		//Pour les erreurs mot de passe
		$this->loadModel('Compte');
	}

	function navigation() {

		$this->Session->write("url", $this->params['url']);
		if (array_key_exists('precedent', $this->params['form'])) {
			$this->redirect(array('controller' => 'inscription_fiche_med', 'action' => 'index'));
		} elseif (array_key_exists('accepter', $this->params['form'])) {
			//si le bouton suivant est cliqué
			//pr($this->params['data']);
			$this->Session->write("session", $this->params['data']);
			//$this->redirect(array('controller'=>'inscription_confirmation', 'action'=>'index'));
		} elseif (array_key_exists('annuler', $this->params['form'])) {
			$this->Session->write('info_gen', null);
			$this->Session->write('fiche_med', null);
			$this->Session->write('InscriptionAutorisation', null);
			$this->redirect(array('controller' => 'accueil', 'action' => 'index'));
			//DEVRAIT REDIRIGER VERS L'ACCUEIL
		}
	}

	function index() {


		$this->navigation();

		$this->set('title_for_layout', __('Autorisations', true));
		$this->set('titre', __('Autorisations', true));
		$this->set('ariane', __('Informations générales > Fiches médicales > <span style="color: green;">Autorisations</span>', true));

		//Chercher les informations du compte
		$validationMDP = $this->Compte->find('first', array('conditions' => array('id' => $this->Session->read('authentification.id_compte'))));

		$information = array();
		$information = $validationMDP['Adulte'][0]['prenom'] . " " . $validationMDP['Adulte'][0]['nom'];

		//Insère le code html pour l'erreur puisque les $this->password ne sont pas géré par les validations de modèles à cause des requêtes
		$erreurMDP = null;
		if (!empty($this->data)) {
			if ($validationMDP['Compte']['mot_de_passe'] == hash('sha256', $this->data['InscriptionAutorisation']['motdepassestr'])) {
				$erreurMDP = null;
				$this->_ajoutEnfant();
			} else {
				$erreurMDP = '<div  style="background: red">*Le mot de passe est invalide</div>';
			}
		}
		$this->set('erreurMDP', $erreurMDP);
		$this->set('parent', $information);
	}

	/**
	 * Enregistrement d'un enfant
	 * @todo Fait en conséquence qu'on n'a pas le temps de faire un compte sans enfant, cette fonction
	 * N'est  pas gérée, l'enfant créer appartient automatiquement à la personne connecter qui l'inscrit (EnfantsAdulte)
	 * @return void
	 */
	private function _ajoutEnfant() {

		//Si les autorisations sont postés, indiquant ainsi que le formulaire est complet
		if (!empty($this->data)) {
			//Créer les intances de la bd nécessaire
			$this->Enfant->create();
			$this->Inscription->create();
			$this->Adresse->create();
			$this->ContactUrgence->create();
			$this->FicheMedicale->create();
			$this->InformationScolaire->create();
			$this->Adulte->create(); //Pour le contact d'urgence obligatoire
			//Pour les autorisations de photo et de baignade
			if (isset($this->data['InscriptionAutorisation']['autorisation_baignade'][0])) {
				$baignade = 1;
			} else {
				$baignade = 0;
			}

			if (isset($this->data['InscriptionAutorisation']['autorisation_photo'][0])) {
				$photo = 1;
			} else {
				$photo = 0;
			}

			//Cherche l'année actuelle soit qui n'est pas finit donc pas de date de fin
			$annee = $this->Annee->find('first', array('conditions' => array('Annee.date_fin' => null)));

			//Enregistrement des données dans la base de données
			if (($this->Adresse->save(array('adresses' => $this->Session->read('info_gen.InformationGenerale.adresse'),
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
				($this->FicheMedicale->save(array('enfant_id' => $this->Enfant->id,
				    'allergie' => $this->Session->read('fiche_med.InscriptionFicheMed.allergie'),
				    'phobie' => $this->Session->read('fiche_med.InscriptionFicheMed.peur')))) &&
				($this->InformationScolaire->save(array('enfant_id' => $this->Enfant->id,
				    'nom_ecole' => $this->Session->read('info_gen.InformationGenerale.etab_scolaire'),
				    'niveau_scolaire' => $this->Session->read('info_gen.InformationGenerale.niveau_scolaire'),
				    'nom_enseignant' => $this->Session->read('info_gen.InformationGenerale.enseignant')))) &&
				($this->Adulte->save(array('nom' => $this->Session->read('info_gen.InformationGenerale.nom_urgence'),
				    'prenom' => $this->Session->read('info_gen.InformationGenerale.prenom_urgence'),
				    'tel_maison' => $this->Session->read('info_gen.InformationGenerale.telephone_principal_urgence')))) &&
				($this->ContactUrgence->save(array('adulte_id' => $this->Adulte->id,
				    'enfant_id' => $this->Enfant->id,
				    'lien' => $this->Session->read('info_gen.InformationGenerale.lien_jeune_urgence'))))) {

				// Pour vérifier le read, on doit le mettre dans une variable avant
				//Autre parent ou tuteur(pas obligatoire), lien avec enfant, création instance adulte
				$tuteur = $this->Session->read('info_gen.InformationGenerale.nom_tuteur');

				if (!empty($tuteur)) {
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

				$prescription = $this->Session->read('fiche_med.InscriptionFicheMed.prescription');
				if (!empty($prescription)) {
					$this->Prescription->create();
					$this->Prescription->save(array('posologie' => $this->Session->read('fiche_med.InscriptionFicheMed.prescription'),
					    'fiche_medicale_id' => $this->FicheMedicale->id));
				}

				//combine les tableaux d'antécédant
				$antecedant = array_merge((array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent1'), (array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent2'), (array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent3'));

				for ($i = 0; $i < count($antecedant); ++$i) {
					if ($antecedant[$i] != '') {
						$this->FicheMedicalesMalady->create();
						$this->FicheMedicalesMalady->save(array('fiche_medicale_id' => $this->FicheMedicale->id, 'maladie_id' => $antecedant[$i]));
					}
				}

				$medicament = $this->Session->read('fiche_med.InscriptionFicheMed.medicamentautoriseLab');
				//Si le tableau combiné n'est pas vide, créer les instances de FicheMedicalMedicament nécessaire

				for ($i = 0; $i < count($medicament); ++$i) {
					if ($medicament[$i] != '') {
						$this->FicheMedicalesMedicament->create();
						$this->FicheMedicalesMedicament->save(array('medicament_id' => $medicament[$i], 'fiche_medicale_id' => $this->FicheMedicale->id));
					}
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

				//Si l'enregistrement a bien été fait, affiche le bon messasge
				//	$this->Session->setFlash(__('Inscription terminée', true));
				$this->redirect(array('controller' => 'inscription_confirmation', 'action' => 'index'));
			} else {

				$this->Session->setFlash(__('Oups, petite erreur, veuillez ressayer plus tard', true));
			}
		}
	}

}
?>