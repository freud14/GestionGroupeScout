<?php
class InscriptionAutorisationController extends AppController {
	var $name = 'InscriptionAutorisation';
	var $helpers = array("Html",'Form');
	
	function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'parent';
			$this->loadModel('Enfant');
			$this->loadModel('Adresse');
			$this->loadModel('AdultesEnfant');
			$this->loadModel('Inscription');
			$this->loadModel('Prescription');
			$this->loadModel('ContactUrgence');
			$this->loadModel('Annee');
			$this->loadModel('FicheMedicale');
			$this->loadModel('FicheMedicalesMalady');
			$this->loadModel('FicheMedicalesMedicament');
	}

	
	
	function navigation(){
		
		$this -> Session -> write("url", $this->params['url']);
		if(array_key_exists ('precedent',$this->params['form']))
 		{
			$this->redirect(array('controller'=>'inscription_fiche_med', 'action'=>'index'));
			
		}elseif( array_key_exists ('accepter',$this->params['form'])){
 		//si le bouton suivant est cliqué
 			//pr($this->params['data']);
 			$this -> Session -> write("session", $this->params['data']);
 			//$this->redirect(array('controller'=>'inscription_confirmation', 'action'=>'index'));
		}
	
	}



	function index(){
			pr($this->Session->read('fiche_med'));
			
			$this->navigation();
		
			$this->set('title_for_layout', __('Autorisations', true));
			$this->set('titre',__('Autorisations',true));
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
		private function _ajoutEnfant(){

		//Si les autorisations sont postés, indiquant ainsi que le formulaire est complet
		if (!empty($this->data)) {
			//Créer les intances de la bd nécessaire
			$this->Enfant->create();
			$this->Inscription->create();
			$this->Adresse->create();
			$this->ContactUrgence->create();
			$this->FicheMedicale->create();


			//convertie le sexe en integer,  puisque la session le garde en string et que la bd est integer
			if( $this->Session->read('info_gen.InformationGenerale.sexe') == 'M'){
				$sexe = 1;
			} else{
				$sexe = 2;
			}


			echo date('Y-m-d', (strtotime($this->Session->read('info_gen.InformationGenerale.date_de_naissance.year').
											 $this->Session->read('info_gen.InformationGenerale.date_de_naissance.month').
														 $this->Session->read('info_gen.InformationGenerale.date_de_naissance.day')
															)));
			pr( $this->data['Autorisation']['autorisation_baignade'][0]);

			//Cherche l'année actuelle soit qui n'est pas finit donc pas de date de fin
			$annee = $this->Annee->find('first', array('conditions' => array('Annee.date_fin' => null)));
			echo 'inb4 if';
				//Enregistrement des données dans la base de données
				if (($this->Enfant->save(array('nom' => $this->Session->read('info_gen.InformationGenerale.nom'), 
											'prenom' => $this->Session->read('info_gen.InformationGenerale.prenom'),
											'date_naissance' => date('Y-m-d', (strtotime(
											 	$this->Session->read('info_gen.InformationGenerale.date_de_naissance.year').
											 	$this->Session->read('info_gen.InformationGenerale.date_de_naissance.month').
												$this->Session->read('info_gen.InformationGenerale.date_de_naissance.day')
															))),
											'adresse_id' => $this->Adresse->id,
											'no_ass_maladie' => $this->Session->read('info_gen.InformationGenerale.assurance_maladie'),
											'sexe' => $sexe,
											'particularite_jeunes' => $this->Session->read('info_gen.InformationGenerale.particularite')))) &&
							($this->Adresse->save(array('adresses' => $this->Session->read('info_gen.InformationGenerale.adresse'),
											'ville' => $this->Session->read('info_gen.InformationGenerale.ville'),
											'code_postal' => $this->Session->read('info_gen.InformationGenerale.code_postal')))) &&
							($this->AdultesEnfant->save(array('adulte_id' =>  $this->Session->read('authentification.id_compte'),
											'enfant_id' => $this->Enfant->id))) &&		
							($this->Inscription->save(array('enfant_id' => $this->Enfant->id, 
											'groupe_age_id' => $this->Session->read('info_gen.InformationGenerale.groupe_age'),
											'date_inscription' => DboSource::expression('NOW()'),
											'annee_id' => $annee['Annee']['id'],
											'autorisation_photo' => $this->data['Autorisation']['autorisation_photo'][0],
											'autorisation_baignade' => $this->data['Autorisation']['autorisation_baignade'][0]))) &&
							($this->FicheMedicale->save(array('enfant_id' => $this->Enfant->id,
											'allergie' => $this->Session->read('fiche_med.InscriptionFicheMed.allergie'),
											'phobie' => $this->Session->read('fiche_med.InscriptionFicheMed.peur'))))){


							echo 'contact';
							//Contact d'urgence si il existe, on doit mettre la variable session dans un tableau sinon on ne peut pas savoir s'il est vide
						    $contactUrgence = (array)$this->Session->read('info_gen.InformationGenerale.lien_jeune_urgence');
							
							if (!empty($contactUrgence)){

								$this->ContactUrgence->save(array('adulte_id' =>  $this->Session->read('authentification.id_compte'),
															'enfant_id' => $this->Enfant->id,
															'lien' => $this->Session->read('info_gen.InformationGenerale.lien_jeune_urgence')));
							}
	
							echo 'prescription';
							// Pour vérifier le read, on doit le mettre dans une variable avant
							$prescription = array();
							$prescription = array_merge((array) $this->Session->read('fiche_med.InscriptionFicheMed.prescription'));
							if (!empty($prescription)){
								$this->Prescription->create();
								$this->Prescription->save(array('posologie' => $this->Session->read('fiche_med.InscriptionFicheMed.prescription'),
													'fiche_medicale_id' => $this->FicheMedicale->id));
							}				

							echo 'fichemedmalady';
							//combine les tableaux d'antécédant
							$antecedent = array();
							
							$buffer = array_merge((array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent1'),(array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent2'),(array) $this->Session->read('fiche_med.InscriptionFicheMed.antecedent3'));
		 
							//Si le tableau combiné n'est pas vide, créer les instances de FicheMedicalMalady nécessaire
							if(!empty($buffer)){
								foreach($buffer as $valeur){
									$this->FicheMedicalesMalady->create();
									$this->FicheMedicalesMalady->save(array('maladie_id' => $valeur, 'fiche_medicale_id' => $this->FicheMedical->id));
								}
							}									
							
							echo 'medicament';
							$medicament = array();
							$medicament = array_merge((array) $this->Session->read('fiche_med.InscriptionFicheMed.medicamentautoriseLab'));
							
							//Si le tableau combiné n'est pas vide, créer les instances de FicheMedicalMedicament nécessaire
							if(!empty($medicament)){
								foreach($medicament as $valeur){
									$this->FicheMedicalesMedicament->create();
									$this->FicheMedicalesMedicament->save(array('medicament_id' => $valeur, 'fiche_medicale_id' => $this->FicheMedicale->id));
								}
							}		

				//Si l'enregistrement a bien été fait, affiche le bon messasge
				//	$this->Session->setFlash(__('Inscription terminée', true));
				echo 'work';
				//	$this->redirect(array('action'=>'view'));


				} else {
					//$this->Session->setFlash(__('Oups, petite erreur, veuillez ressayer plus tard', true));
					echo  'jambon' ;
				}
			} 
	}
}

?>
