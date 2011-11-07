<?php
class InscrireEnfantController extends AppController {
	var $name = 'InscrireEnfant';
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
	}
	
	function index() {
		$this->set('title_for_layout', __('Inscription d\'un enfant', true));
		$this->set('titre', __('Informations générales', true));
		$this->set('ariane', __('<span style="color: green;">Informations générales</span> > Fiches médicales > Autorisations', true));
	}
	
	function fiche_medicale() {
	
	}
}
?>
