<?php
class InscrireEnfantController extends AppController {
	var $name = 'InscrireEnfant';
	var $helpers = array("Html",'Form');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		setlocale(LC_ALL, 'fr_CA.utf8');
	}
	
	function index() {
		$this->loadModel('InformationGenerale');
		if (!empty($this->data)) {
			$this->InscrireEnfant->set($this->data);
			if($this->InscrireEnfant->validates()) {
				echo "valide";
			} else {
				echo "invalide";
			}
		}
		//else {
			$this->set('title_for_layout', __('Inscription d\'un enfant', true));
			$this->set('titre', __('Informations générales', true));
			$this->set('ariane', __('<span style="color: green;">Informations générales</span> > Fiches médicales > Autorisations', true));
		//}
		
		$this->loadModel('GroupeAge');
		$this->set('groupe_age', $this->GroupeAge->find('all'));
	}
	
	function confirmation_inscription()
	{
	
		$this->set('title_for_layout', __('Inscription d\'un enfant réussie', true));
		$this->set('titre',__('Fin de l\'inscrtiption',true));
		if ( array_key_exists ('paiement',$this->params['form']))
 		{
 		//si le bouton précédent est cliqué
 		
 			//$this -> Session -> write("session", $this->params['data']);
 			$this -> Session -> write("url", $this->params['url']);
 			$this->redirect('../gestionnaire_paiement');
 		}elseif ( array_key_exists ('inscription',$this->params['form']))
 		{
 		//si le bouton précédent est cliqué
 		
 			//$this -> Session -> write("session", $this->params['data']);
 			$this -> Session -> write("url", $this->params['url']);
 			$this->redirect('../information_generale');
 		}
 		
		//$this->set('ariane', __('Informations générales > <span style="color: green;">Fiches médicales</span> > Autorisations', true));
	}
	

	
	function autorisation(){
		if(array_key_exists ('precedent',$this->params['form']))
 			{
 				$this -> Session -> write("url", $this->params['url']);
				$this->redirect('fiche_medicale');
			
			}elseif( array_key_exists ('accepter',$this->params['form']))
 			{
 		//si le bouton suivant est cliqué
 			$this -> Session -> write("session", $this->params['data']);
 			$this -> Session -> write("url", $this->params['url']);
 			$this->redirect('confirmation_inscription');
			}
			
		
			$this->set('title_for_layout', __('Autorisations', true));
			$this->set('titre',__('Autorisations',true));
			$this->set('ariane', __('Informations générales > Fiches médicales > <span style="color: green;">Autorisations</span>', true));
	}
	
	public function getMaladieListe()
	{
		return $this->Maladie->find('all');
	}
	
	public function getQuestionListe()
	{
		return $this->QuestionGenerale->find('all');
	}
	public function getMedicamentListe()
	{
		return $this->Medicament->find('all');
	}
	
}
?>
