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
		
		$id_compte = 0;
		
		$this->loadModel('Versement');
		$versements = $this->Versement->find('all', array('conditions' => 'NbVersement.nb_versements = 1', 'order' => array('Fraterie.position', 'Versement.position')));

		$nb_inscription_paye = $this->GestionnairePaiement->getNbInscriptionPayé($id_compte);
		$inscriptions = $this->GestionnairePaiement->getInscriptionNonPayé($id_compte);

		/*echo '$inscriptions<br />';
		pr($inscriptions);
		echo '$versements<br />';
		pr($versements);
		echo '$this->data<br />';
		pr($this->data);*/
		if(!empty($this->data)) {
			$indexProchainVersement = 0;
			for($i = 0; $i < count($versements); ++$i) {
				$indexProchainVersement = $i;
				if($versements[$i]['Fraterie']['position'] == $nb_inscription_paye + 1) {
					break;
				}
				else if($versements[$i]['Fraterie']['position'] > $nb_inscription_paye + 1) {
					--$indexProchainVersement;
					break;
				}
			}
			
			$position = $nb_inscription_paye + 1;
			$inscriptionAPayer = array();
			foreach($inscriptions as $inscription) {
				if(array_key_exists('inscription'.$inscription['Inscription']['id'], $this->data['GestionnairePaiement']) &&
					 $this->data['GestionnairePaiement']['inscription'.$inscription['Inscription']['id']] == $inscription['Inscription']['id']) {
					
					$inscriptionAPayer[$inscription['Inscription']['id']] = $versements[$indexProchainVersement]['Versement'];
					++$position;
					if($position > $versements[$indexProchainVersement]['Fraterie']['position'] &&
					   $indexProchainVersement < count($versements) - 1) {
						++$indexProchainVersement;					
					}
					
				}
			}
			
			$this->loadModel('Facture');
			$idModePaiement = $this->data['GestionnairePaiement']['mode'];
			foreach($inscriptionAPayer as $idInscription => $versement) {
				$this->Facture->create();
				$insert = array('no_facture' => 'a', 'date_facturation' => DboSource::expression('NOW()'), 'inscription_id' => $idInscription, 'nb_versement_id' => $versement['nb_versement_id'], 'fraterie_id' => $versement['fraterie_id'], 'paiement_type_id' => $idModePaiement);
				//pr($insert);
				$this->Facture->save($insert);
			}
			
			$this->redirect(array('controller'=>'gestionnaire_paiement', 'action'=>'index'));
			//echo '$inscriptionAPayer<br />';
			//pr($inscriptionAPayer);
		}
		//else {
			$this->set('versements', $versements);
					
			$this->set('nb_inscription_paye', $nb_inscription_paye);
			$this->set('inscriptions', $inscriptions);
		//}
		
	}
}
?>
