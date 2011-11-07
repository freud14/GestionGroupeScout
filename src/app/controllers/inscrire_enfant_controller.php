<?php
class InscrireEnfantController extends AppController {
	var $name = 'InscrireEnfant';
	var $helpers = array("Html",'Form');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		$this->loadModel('Malady');
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
		//pr($this->getMaladieList());
	}
	
	function fiche_medicale() {
		$this->set('title_for_layout', __('Inscription d\'un enfant', true));
		$this->set('titre',__('Fiche médicale',true));
		$this->set('ariane', __('Informations générales > <span style="color: green;">Fiches médicales</span> > Autorisations', true));
<<<<<<< HEAD
	}
	
	public function getMaladieList(){
		return $this->Malady->find('all');
=======
		$this->loadModel("Medicament");
		pr($this->getMaladieList());
	}
	
	public function getMaladieList(){
		return $this->Medicament->find('all');
>>>>>>> b5eee3bcf217110ded05e7e4cc6749127d353ada
	}
}
?>
