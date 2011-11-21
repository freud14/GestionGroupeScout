<?php

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
		}
	}

	function index() {
		pr($this->Session->read('fiche_med'));

		$this->navigation();

		$this->set('title_for_layout', __('Autorisations', true));
		$this->set('titre', __('Autorisations', true));
		$this->set('ariane', __('Informations générales > Fiches médicales > <span style="color: green;">Autorisations</span>', true));

		pr($this->Session->read());

		$this->_ajoutEnfant();
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

			//Pour les autorisations de photo et de baignade
			if (isset($this->data['Autorisation']['autorisation_baignade'][0])) {
				$baignade = 1;
			} else {
				$baignade = 0;
			}

			if (isset($this->data['Autorisation']['autorisation_photo'][0])) {
				$photo = 1;
			} else {
				$photo = 0;
			}

			//Cherche l'année actuelle soit qui n'est pas finit donc pas de date de fin
			$annee = $this->Annee->find('first', array('conditions' => array('Annee.date_fin' => null)));

			//Adulte, mmetre l'id dans la session ???????
			$adulte = $this->Adulte->find('first', array('conditions' => array('Adulte.compte_id' => $this->Session->read('authentification.id_compte'))));

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
					/*($this->AdultesEnfant->save(array('adulte_id' => $adulte['Adulte']['id'],
						'enfant_id' => $this->Enfant->id))) &&
					($this->Inscription->save(array('enfant_id' => $this->Enfant->id,
						'groupe_age_id' => $this->Session->read('info_gen.InformationGenerale.groupe_age'),
						'date_inscription' => DboSource::expression('NOW()'),
						'annee_id' => $annee['Annee']['id'],
						'autorisation_photo' => $photo,
						'autorisation_baignade' => $baignade))) &&*/
					($this->FicheMedicale->save(array('enfant_id' => $this->Enfant->id,
						'allergie' => $this->Session->read('fiche_med.InscriptionFicheMed.allergie'),
						'phobie' => $this->Session->read('fiche_med.InscriptionFicheMed.peur')))) /*&&
					($this->InformationScolaire->save(array('enfant_id' => $this->Enfant->id,
						'nom_ecole' => $this->Session->read('info_gen.InformationGenerale.etab_scolaire'),
						'niveau_scolaire' => $this->Session->read('info_gen.InformationGenerale.niveau_scolaire'),
						'nom_enseignant' => $this->Session->read('info_gen.InformationGenerale.enseignant'))))*/) {



				/*//Contact d'urgence si il existe, on doit mettre la variable session dans un tableau sinon on ne peut pas savoir s'il est vide
				$contactUrgence = (array) $this->Session->read('info_gen.InformationGenerale.lien_jeune_urgence');
				if (!empty($contactUrgence)) {

					//Cherche l'adulte pour le contact d'urgence
					$urgence = $this->Adulte->find('first', array('conditions' => array('Adulte.courriel' => $this->Session->read('info_gen.InformationGenerale.lien_jeune_urgence'))));
					$this->ContactUrgence->save(array('adulte_id' => $urgence['Adulte']['id'],
						'enfant_id' => $this->Enfant->id,
						'lien' => $this->Session->read('info_gen.InformationGenerale.lien_jeune_urgence')));
				}

				// Pour vérifier le read, on doit le mettre dans une variable avant
				$prescription = array_merge((array) $this->Session->read('fiche_med.InscriptionFicheMed.prescription'));
				if (!empty($prescription)) {
					$this->Prescription->create();
					$this->Prescription->save(array('posologie' => $this->Session->read('fiche_med.InscriptionFicheMed.prescription'),
						'fiche_medicale_id' => $this->FicheMedicale->id));
				}*/
				
				$antecedant = array_merge((array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent1'), (array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent2'), (array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent3'));
				for($i = 0; $i < count($antecedant); ++$i) {
					if($antecedant[$i] != '') {
						$this->FicheMedicale->FicheMedicalesMalady->create();
						$this->FicheMedicale->FicheMedicalesMalady->save(array('fiche_medicale_id' => $this->FicheMedicale->id, 'maladie_id' => $antecedant[$i]));
					}
				}
				/*$this->loadModel('Maladie');
				$antecedant = array_merge((array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent1'), (array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent2'), (array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent3'));
				$antecedantInsert = array();
				for($i = 0; $i < count($antecedant); ++$i) {
					if($antecedant[$i] != '') {
						$this->Maladie->id = $antecedant[$i];
						$antecedantInsert[] = $this->Maladie->read();
					}
				}
				$antecedantInsert = array('FicheMedicale' => $this->FicheMedicale->read(), 'Maladie' => $antecedantInsert);
				pr($antecedantInsert);
				$this->FicheMedicale->saveAll($antecedantInsert);*/
				
				/*//combine les tableaux d'antécédant
				$antecedant = array_merge((array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent1'), (array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent2'), (array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent3'));
				//Si le tableau combiné n'est pas vide, créer les instances de FicheMedicalMalady nécessaire
				if (!empty($antecedant)) {
					foreach ($antecedant as $valeur) {
						$this->FicheMedicalesMalady->create();
						$this->FicheMedicalesMalady->saveAll(array('maladie_id' => $valeur, 'fiche_medicale_id' => $this->FicheMedicale->id));
					}
				}*/

				/*$medicament = array_merge((array) $this->Session->read('fiche_med.InscriptionFicheMed.medicamentautoriseLab'));
				//Si le tableau combiné n'est pas vide, créer les instances de FicheMedicalMedicament nécessaire
				if (!empty($medicament)) {
					foreach ($medicament as $valeur) {
						$this->FicheMedicalesMedicament->create();
						$this->FicheMedicalesMedicament->save(array('medicament_id' => $valeur, 'fiche_medicale_id' => $this->FicheMedicale->id));
					}
				}*/

				//Si l'enregistrement a bien été fait, affiche le bon messasge
				$this->Session->setFlash(__('Inscription terminée', true));
				echo 'work';
				//	$this->redirect(array('action'=>'view'));
			} else {
				$this->Session->setFlash(__('Oups, petite erreur, veuillez ressayer plus tard', true));
				echo 'jambon';
			}
		}
	}

}

?>
