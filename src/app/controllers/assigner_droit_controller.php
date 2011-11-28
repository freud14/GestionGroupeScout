<?php
//App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class AssignerDroitController extends AppController {

		 var $helpers = array('Html', 'Javascript', 'Form');  
		 var $name = 'AssignerDroit';
		// var $components = array(array('Recaptcha.Captcha' => array(
          //      'private_key' => '6Ldq4MkSAAAAACIFrlwaf209zjAOhktImcx_FjlS', 
            //    'public_key' => '6Ldq4MkSAAAAABiDfADZgxzR3Nn_wB4qppT9QBKy'))); 

		function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'admin';
			$this->loadModel("Compte");
			$this->loadModel('AutorisationsCompte');

		}

		
		/**
		 * view method
		 *
		 * @param string $id
		 * @return void
		 */
		 private function _navigation() {
			
			//si le bouton enregister est cliqué
			if ( array_key_exists ('enregistrer',$this->params['form']))
 			{
 				$this->_updateDroit();
 				
 				//$this->redirect(array('controller'=>'information_generale', 'action'=>'index'));
 			
 			}elseif( array_key_exists ('annuler',$this->params['form']))
 			{
 			//si le bouton suivant est cliqué	
 				$this->redirect(array('controller'=>'accueil', 'action'=>'index'));
 			
 			}
 	
		}
		
	public function index() {
			
 		if ($this->_getAutorisation() < 4) {
			$this->redirect(array('controller' => 'accueil', 'action' => 'index'));
		}
 		
 		
		$this->set('title_for_layout', __('Gestionnaire des droits', true));
		$this->set('titre',__('Gestionnaire des droits',true));
		
		if(!empty($this->data)){
			$this->_navigation();
		}
		$resultats = $this->Compte ->find('all');
		
		$nonMembres = array();
		
		
		
		foreach($resultats as $valeur){
			if(empty($valeur['Autorisation'])){
				$nonMembres[$valeur['Compte']['id']] = array(1=>0,2=>0,3=>0,4=>0,
										'nom' => $valeur['Adulte'][0]['prenom']." ".$valeur['Adulte'][0]['nom']
										);
			}else{
				//$membres[$valeur['Compte']['id']] = $valeur['Adulte'][0]['prenom']." ".$valeur['Adulte'][0]['nom'];
				$membres[$valeur['Compte']['id']] = array(
										'nom' => $valeur['Adulte'][0]['prenom']." ".$valeur['Adulte'][0]['nom']
									 );
				
				foreach($valeur['Autorisation'] as $droit)
				{
					
					$membres[$valeur['Compte']['id']][] = $droit['id'];
				}
			}
			
		}
	
		$this->set('nonMembre',$nonMembres);
		$this->set('membre',$membres);
		//$this->set('droit',$tabDroits);
			//$this->_updateDroit();	
		
		
	}
	private function _updateDroit(){
		$tabVieuDroit = array();
		$resultats = $this->Compte ->find('all');
		//pr($resultats);
		//on sort les droits de la bd
		foreach($resultats as $membre)
		{
			$tabVieuDroit[$membre['Compte']['id']] = null;
			foreach($membre['Autorisation'] as $autorisation)
			{
				
				$tabVieuDroit[$membre['Compte']['id']][] = $autorisation['id'];
			}
		}
		
		$tabNouveauDroit = (array)$this->data['AssignerDroit'];
				
		foreach($tabNouveauDroit as $idMembre => $nouveauDroit)
		{
			//si les droits on changé
			if($nouveauDroit != $tabVieuDroit[$idMembre])
			{
				pr("sa a changer");
				//on enleve les anciens droits pour ne pas faire de conflit
				$this->AutorisationsCompte->deleteAll(array('compte_id' => $idMembre));
				//si le membre a de nouveau droit on les ajoutes
				if(!empty($nouveauDroit))
				{	
				// On cree les nouveaux droits du membre
					foreach($nouveauDroit as $idDroit)
					{
						$this->AutorisationsCompte->create();
						$this->AutorisationsCompte->save(array('autorisation_id' => $idDroit, 'compte_id' => $idMembre));
					}
				}
			}
		}
		/*$this->AdultesImplication->deleteAll(array('adulte_id' => $this->Session->read('authentification.id_adulte')));
									
					foreach($this->data['InscrireAdulte']['Implication'] as $impl) {
					
									}*/
									
									
	}
}
?>
