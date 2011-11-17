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
			$this->laodModel('Annee');
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

		if (!empty($this->data)) {
						//Créer les intances de la bd nécessaire
					$this->Enfant->create();
					$this->Inscription->create();
					$this->Adresse->create();
					
					$annee = $this->Annee->find('first', array('conditions' => array('annee.date_fin' => null)));

								//Enregistrement des données dans la base de données
						if ($this->Enfant->save(array('nom' => $this->Session->read('info_gen.InformationGeneral.nom'), 
												    'prenom' => $this->Session->read('info_gen.InformationGeneral.prenom'),
													'date_de_naissance' => array($this->Session->read('info_gen.InformationGeneral.date_de_naissance.day'),
																				$this->Session->read('info_gen.InformationGeneral.date_de_naissance.month'),
																				$this->Session->read('info_gen.InformationGeneral.date_de_naissance.year')),
													'adresse_id' => $this->Adresse->id,
													'no_ass_maladie' => $this->Session->read('info_gen.InformationGeneral.assurance_maladie'),
													'sexe' => $this->Session->read('info_gen.InformationGeneral.sexe')
													'particularite_jeunes' => $this->Session->read('info_gen.InformationGeneral.particularite')) &&
									($this->Adresse->save(array('adresses' => $this->Session->read('info_gen.InformationGeneral.adresse'),
													'ville' => $this->Session->read('info_gen.InformationGeneral.ville'),
													'code_postal' => $this->Session->read('info_gen.InformationGeneral.code_postal')))) &&
									($this->Inscription->save(array('enfant_id' => $this->Enfant->id, 
													'groupe_age_id' => $this->Session->read('info_gen.InformationGeneral.groupe_age'),
													'date_inscription' => DboSource::expression('NOW()'),
													'annee_id' => $annee['Annee']['id'],
													'autorisation_photo' => $this->data['Autorisation']['message1']
													
													
													
													
													
													{

							
								//Si une implication est existante	
								if ((isset($this->data['InscrireAdulte']['Implication'])) && (!empty($this->data['InscrireAdulte']['Implication']))){

								
									foreach($this->data['InscrireAdulte']['Implication'] as $impl) {
										$this->AdultesImplication->create();
										$this->AdultesImplication->save(array('implication_id' => $impl, 'adulte_id' => $this->Adulte->id));
					:w
					}
								}

								//Si l'enregistrement a bien été fait, affiche le bon messasge
								$this->Session->setFlash(__('Inscription terminée', true));
								$this->redirect(array('action'=>'view'));
						} else {
							$this->Session->setFlash(__('Oups, petite erreur, veuillez ressayer plus tard', true));
						}
			} 
	
	}



?>
