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
		
		$this->loadModel("Inscription");
		$this->set('inscriptions', $this->_getInscriptions());
		
		$this->loadModel("Fraterie");
		$this->set('frateries', $this->Fraterie->find('all', array('recursive' => 2)));
	}
	
	function _getInscriptions() {
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
	}
}
?>
