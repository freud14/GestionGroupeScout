<?php
class PaiementMembreController extends AppController {
	var $name = 'PaiementMembre';
	var $helpers = array("Html",'Form');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
		setlocale(LC_ALL, 'fr_CA.utf8');
		$this->set('title_for_layout', __('Gestion des paiements', true));
	}
	
	function index() {
		$this->set('titre',__('Gestion des paiements',true));
		$this->set('ariane', __('Gestion des paiements', true));
		
		$recherche = NULL;
		if(!empty($this->data)) {
			if(isset($this->data['PaiementMembre']['recherche']) && !empty($this->data['PaiementMembre']['recherche'])) {
				$recherche = $this->data['PaiementMembre']['recherche'];
			}
		}
		
		if($recherche != NULL) {
			$this->set('recherche', $recherche);
		}
		
		$this->set('statuts', $this->PaiementMembre->getStatutPaiementMembre($recherche));
	}
}
?>
