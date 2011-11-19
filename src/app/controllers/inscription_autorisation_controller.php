<?php
class InscriptionAutorisationController extends AppController {
	var $name = 'InscriptionAutorisation';
	var $helpers = array("Html",'Form');
	
	function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'parent';
			$this->loadModel('Compte');
			$this->loadModel('Adulte');
			$this->loadModel('AdultesImplication');
			$this->loadModel('Implication');
			$this->loadModel('Annee');
			$this->loadModel('FicheMedical');
			$this->loadModel('FicheMedicalesMalady');
			$this->loadModel('FicheMedicalesMedicament');
	}

	
	
	
	
	function navigation(){
		
		$this -> Session -> write("url", $this->params['url']);
		if(array_key_exists ('precedent',$this->params['form']))
 		{
			$this->redirect(array('controller'=>'inscription_fiche_med', 'action'=>'index'));
			
		}elseif( array_key_exists ('accepter',$this->params['form']))
 		{
 		//si le bouton suivant est cliqué
 			//pr($this->params['data']);
 			$this -> Session -> write("session", $this->params['data']);
 			$this->redirect(array('controller'=>'inscription_confirmation', 'action'=>'index'));
		}
	
	}
	function index(){
			pr($this->Session->read('fiche_med'));
			
			$this->navigation();
		
			$this->set('title_for_layout', __('Autorisations', true));
			$this->set('titre',__('Autorisations',true));
			$this->set('ariane', __('Informations générales > Fiches médicales > <span style="color: green;">Autorisations</span>', true));
			
		pr($this->Session->read());
	}
	
			/**
		 *Enregistrement d'un enfant 
		 * @return void
		 */
		private function _ajoutEnfant(){


		//Si les autorisations sont postés
		if (!empty($this->data)) {
					//Créer les intances de la bd nécessaire
					$this->Enfant->create();
					$this->Inscription->create();
					$this->Adresse->create();
					$this->ContactUrgence->create();
					$this->FicheMedical->create();
					
				

				
					//Cherche l'année actuelle soit qui n'est pas finit donc pas de date de fin
					$annee = $this->Annee->find('first', array('conditions' => array('annee.date_fin' => null)));

						//Enregistrement des données dans la base de données
						if (($this->Enfant->save(array('nom' => $this->Session->read('info_gen.InformationGeneral.nom'), 
												    'prenom' => $this->Session->read('info_gen.InformationGeneral.prenom'),
													'date_de_naissance' => array($this->Session->read('info_gen.InformationGeneral.date_de_naissance.day'),
																				$this->Session->read('info_gen.InformationGeneral.date_de_naissance.month'),
																				$this->Session->read('info_gen.InformationGeneral.date_de_naissance.year')),
													'adresse_id' => $this->Adresse->id,
													'no_ass_maladie' => $this->Session->read('info_gen.InformationGeneral.assurance_maladie'),
													'sexe' => $this->Session->read('info_gen.InformationGeneral.sexe'),
													'particularite_jeunes' => $this->Session->read('info_gen.InformationGeneral.particularite')))) &&
									($this->Adresse->save(array('adresses' => $this->Session->read('info_gen.InformationGeneral.adresse'),
													'ville' => $this->Session->read('info_gen.InformationGeneral.ville'),
													'code_postal' => $this->Session->read('info_gen.InformationGeneral.code_postal')))) &&
									($this->Inscription->save(array('enfant_id' => $this->Enfant->id, 
													'groupe_age_id' => $this->Session->read('info_gen.InformationGeneral.groupe_age'),
													'date_inscription' => DboSource::expression('NOW()'),
													'annee_id' => $annee['Annee']['id'],
													'autorisation_photo' => $this->data['Autorisation']['autorisation_photo'],
													'autorisation_baignade' => $this->data['Autorisation']['autorisation_baignade']))) &&
									($this->ContactUrgence->save(array('adulte_id' =>  $this->Session->read('authentification.Adulte.id'),
													'enfant_id' => $this->Enfant->id,
													'lien' => $this->Session->read('info_gen.InformationGeneral.lien_jeune_urgence')))) &&
									($this->FicheMedical->save(array('enfant_id' => $this->Enfant->id,
													'allergie' => $this->Session->read('fiche_med.InscriptionFicheMed.allergie'),
													'phobie' => $this->Session->read('fiche_med.InscriptionFicheMed.peur'))))){

							// Pour vérifier le read, on doit le mettre dans une variable avant
							$prescription = array();
							$prescription = (array) $this->Session->read('fiche_med.InscriptionFicheMed.prescription');
							if (!empty($prescription)){
								$this->Prescription->create();
								$this->Prescription->save(array('posologie' => $this->Session->read('fiche_med.InscriptionFicheMed.prescription'),
													'fiche_medicale_id' => $this->FicheMedical->id));
							}					


							//combine les tableaux d'antécédant
							$antecedent = array();
							
							$buffer = array_merge((array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent1'),(array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent2'),(array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent3'));
		 
		 					//Si le tableau combiné n'est pas vide, créer les instances de FicheMedicalMalady nécessaire
							if(!empty($buffer)){
								foreach($buffer as $valeur){
									$this->FicheMedicalesMalady->create();
									$this->FicheMedicalesMalady->save(array('maladie_id' => $valeur, 'fiche_medical_id' => $this->FicheMedical->id));
								}
							}									
					
							
							$medicament = array();
							$medicament = array_merge((array) $this->Session->read('fiche_med.InscriptionFicheMed.medicamentautoriseLab'));
							
							//Si le tableau combiné n'est pas vide, créer les instances de FicheMedicalMedicament nécessaire
							if(!empty($medicament)){
								foreach($medicament as $valeur){
									$this->FicheMedicalesMedicament->create();
									$this->FicheMedicalesMedicament->save(array('medicament_id' => $valeur, 'fiche_medical_id' => $this->FicheMedical->id));
								}
							}		

							
						}

								//Si l'enregistrement a bien été fait, affiche le bon messasge
								$this->Session->setFlash(__('Inscription terminée', true));
							//	$this->redirect(array('action'=>'view'));
						} else {
							$this->Session->setFlash(__('Oups, petite erreur, veuillez ressayer plus tard', true));
						}
			} 
	
	}



?>
