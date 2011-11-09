<?php
class GestionnairePaiementController extends AppController {
	var $name = 'GestionnairePaiement';
	var $helpers = array("Html",'Form');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		setlocale(LC_ALL, 'fr_CA.utf8');
	}
	
	function index() {
		$this->set('title_for_layout', __('Gestionaire de paiements', true));
		$this->set('titre',__('Gestionaire de paiements',true));
		$this->set('ariane', __('Gestionaire de paiements', true));
		$this->loadModel("Fraterie");
		$this->set('frateries', $this->Fraterie->find('all', array('recursive' => 2)));
	}
}
?>
