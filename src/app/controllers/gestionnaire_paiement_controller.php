<?php
class GestionnairePaiementController extends AppController {
	var $name = 'GestionnairePaiement';
	var $helpers = array("Html",'Form');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		setlocale(LC_ALL, 'fr_CA.utf8');
		$this->set('title_for_layout', __('Gestionaire de paiements', true));
	}
	
	function index() {
		$this->set('titre',__('Gestionaire de paiements',true));
		$this->set('ariane', __('Gestionaire de paiements', true));
		
		//$this->loadModel("Inscription");
		//$this->set('inscriptions', $this->_getInscriptions());
		$id_compte = 0;
		$this->set('inscriptions', $this->GestionnairePaiement->getInscriptions($id_compte));
		
		//$this->loadModel("Versement");
		//$this->set('frateries', $this->Fraterie->find('all', array('recursive' => 2)));
		//$this->set('montants_versement', $this->Versement->find('all', array('conditions' => 'Versement.date IS NOT NULL', 'fields' => 'DISTINCT Versement.date', 'order' => 'Versement.date')));
		//$this->set('frateries', $this->Versement->find('all', array('order' => array('Fraterie.position', 'Versement.position'))));
	}
	
	function effectuer_paiement() {
		$this->set('titre',__('Effectuer un paiement',true));
		$this->set('ariane', __('Gestionaire de paiements > Effectuer un paiement', true));
		
		$this->loadModel('Versement');
		$this->set('frateries', $this->Versement->find('all', array('order' => array('Fraterie.position', 'Versement.position'))));
		$this->set('versements', $this->Versement->find('all', array('conditions' => 'NbVersement.nb_versements = 1', 'order' => array('Fraterie.position', 'Versement.position'))));
	}
	
	/*function _getInscriptions() {
		$retour = array();
		$inscriptions = $this->Inscription->find('all', array('recursive' => 4));
		pr($inscriptions);
		foreach($inscriptions as $inscription) {
			$retour[] = array();
			$i = count($retour) - 1;
			$retour[$i]['nom'] = $inscription['Enfant']['nom'];
			$retour[$i]['mode_paiement'] = __('Indéterminé', true);
			$retour[$i]['montant_paye'] = 0;
			$retour[$i]['cout_total'] = 0;
			$retour[$i]['etat'] = 'Impayé';
			$retour[$i]['date_dernier_paiement'] = 'N/A';
			$retour[$i]['date_prochain_paiement'] = 'N/A';

			$factures = $inscription['Facture'];
			foreach($factures as $facture) {
				$paiements = $facture['Paiement'];
				$date_dernier_paiement = 0;
				foreach($paiements as $paiement) {
					$retour[$i]['montant_paye'] += $paiement['montant'];
					
					//On regarde si le type de paiement est spécifié.
					if(array_key_exists('nom', $paiement['PaiementType'])) {
						$retour[$i]['mode_paiement'] = $paiement['PaiementType']['nom'];
					}
					
					//On trouve la date du dernier paiement
					$date_tmp = strtotime($paiement['date_paiements']);
					if($date_tmp > $date_dernier_paiement) {
						$retour[$i]['date_dernier_paiement'] = $paiement['date_paiements'];
					}
				}
				
				//On trouve le coût de l'inscription
				$versements = $facture['NbVersement'];
				foreach($versements as $versement) {
					//if($versement
				}
			}
		}
		return $retour;
	}*/
}
?>
