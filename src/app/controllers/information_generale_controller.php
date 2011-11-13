<?php
class InformationGeneraleController extends AppController {
	var $name = 'InformationGenerale';
	var $helpers = array("Html",'Form');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		setlocale(LC_ALL, 'fr_CA.utf8');
	}
	
	function index() {
		if (!empty($this->data)) {
			$this->InformationGenerale->set($this->data);
			if($this->InformationGenerale->validates()) {
				$this->redirect(array('controller'=>'inscrire_enfant', 'action'=>'fiche_medicale'));
			} else {
				//echo "invalide";
			}
			//pr($this->InformationGenerale->invalidFields());
		}
		//else {
			$this->set('title_for_layout', __('Inscription d\'un enfant', true));
			$this->set('titre', __('Informations générales', true));
			$this->set('ariane', __('<span style="color: green;">Informations générales</span> > Fiches médicales > Autorisations', true));
		//}
		
		$this->loadModel('GroupeAge');
		$this->set('groupe_age', $this->GroupeAge->find('all'));
	}
}
?>
