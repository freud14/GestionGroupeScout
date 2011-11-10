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
		if (!empty($this->data)) {
			$this->InscrireEnfant->set($this->data);
			if($this->InscrireEnfant->validates()) {
				echo "valide";
			} else {
				echo "invalide";
			}
			pr($this->InscrireEnfant->invalidFields());
		}
		//else {
			$this->set('title_for_layout', __('Inscription d\'un enfant', true));
			$this->set('titre', __('Informations générales', true));
			$this->set('ariane', __('<span style="color: green;">Informations générales</span> > Fiches médicales > Autorisations', true));
		//}
		
		$this->loadModel('GroupeAge');
		$this->set('groupe_age', $this->GroupeAge->find('all'));
	}
	
	function fiche_medicale() {
		if ( array_key_exists ('precedent',$this->params['form']))
 		{
 			pr($this->params['form']);
 		}elseif( array_key_exists ('suivant',$this->params['form']))
 		{
 			$this -> Session -> write("session", $this->params['data']);
			$this -> Session -> write("url", $this->params['url']);
 			$this->redirect('autorisation');
 		}
		$this->set('title_for_layout', __('Inscription d\'un enfant', true));
		$this->set('titre',__('Fiche médicale',true));
		$this->set('ariane', __('Informations générales > <span style="color: green;">Fiches médicales</span> > Autorisations', true));
		
		$this->loadModel("Maladie");
		$this->set('maladies', $this->getMaladieListe());
		
		$this->loadModel('QuestionGenerale');
		$this->set('questions', $this->getQuestionListe());
		
		$this->loadModel('Medicament');
		$this->set('medicaments', $this->getMedicamentListe());
		pr($this->data);
		pr($this->params); 
	}
	function cache(){
	
	}
	function autorisation(){
		pr(($this -> Session -> read()));
		$this->set('title_for_layout', __('Autorisations', true));
		$this->set('titre',__('Autorisations',true));
		$this->set('ariane', __('Informations générales > Fiches médicales > <span style="color: green;">Autorisations</span>', true));
	}
	
	public function getMaladieListe(){
		return $this->Maladie->find('all');
	}
	
	public function getQuestionListe(){
		return $this->QuestionGenerale->find('all');
	}
	public function getMedicamentListe(){
		return $this->Medicament->find('all');
	}
	
}
?>
