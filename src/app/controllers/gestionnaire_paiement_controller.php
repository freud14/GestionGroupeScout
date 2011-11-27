<?php

define('PAYPAL', 2);
/**
 * Cette classe gère la gestion des paiements pour
 * les parents.
 */
class GestionnairePaiementController extends AppController {

	/**
	 * Le nom du contrôleur
	 * @var string
	 */
	var $name = 'GestionnairePaiement';

	/**
	 * Les différents Helpers utilisés par le contrôleur et la vue.
	 * @var array
	 */
	var $helpers = array("Html", 'Form');

	/**
	 * Les composants utilisés par le contrôleur.
	 * @var array
	 */
	var $components = array('InformationPaiement', 'Email');

	/**
	 * Cette méthode initialise le contrôleur.
	 */
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		$this->loadModel('Compte');
		$this->loadModel('Adulte');
		$this->loadModel('Inscription');
		$this->loadModel('Annee');
		$this->loadModel('Facture');
		$this->loadModel('Paiement');
		$this->loadModel('Unite');
		setlocale(LC_ALL, 'fr_CA.utf8');
		$this->set('title_for_layout', __('Gestionaire de paiements', true));
	}

	/**
	 * Cette méthode sert à afficher le statut du paiement
	 * d'un parent. Par défaut, les enfants du parent courrant
	 * sont affichés. Si l'utilisateur actuel est un administrateur
	 * et qu'un id est envoyé, les enfants du parent dont l'id
	 * est envoyé sont affichés.
	 * @param type $adulte_id L'id de l'adulte
	 */
	function index($adulte_id = NULL) {
		if ($adulte_id == NULL) {
			$this->set('titre', __('Gestionaire de paiements', true));
			$this->set('ariane', __('Gestionaire de paiements', true));

			$adulte_id = $this->Session->read('authentification.id_adulte');
			$this->set('inscriptions', $this->GestionnairePaiement->getInscriptions($adulte_id));
		} else {
			$this->layout = 'admin';
			$this->set('title_for_layout', __('Gestion des paiements', true));
			$this->set('titre', __('Statut du paiement', true));
			$this->set('ariane', __('Gestion des paiements > Statut du paiement', true));

			$this->set('inscriptions', $this->GestionnairePaiement->getInscriptions($adulte_id));
			$this->set('admin', true);
			$this->set('id_adulte', $adulte_id);
		}
	}

	/**
	 * Cette méthode sert à initialiser et à gérer le
	 * paiement d'un membre. Par contre, elle ne permet pas
	 * de spécifier la date de réception et de paiement
	 * ce qui doit se faire par un administrateur.
	 */
	function effectuer_paiement() {
		$this->set('titre', __('Effectuer un paiement', true));
		$this->set('ariane', __('Gestionaire de paiements > Effectuer un paiement', true));

		$adulte_id = $this->Session->read('authentification.id_adulte');

		if (!empty($this->data)) {
			$inscriptions = array();
			$keys = preg_grep("/^inscription([0-9]+)$/", array_keys($this->data['GestionnairePaiement']));
			foreach ($keys as $key) {
				if ($this->data['GestionnairePaiement'][$key] != 0) {
					$inscriptions[] = $this->data['GestionnairePaiement'][$key];
				}
			}
			
			$montant_total = $this->InformationPaiement->créerPaiements($adulte_id, $inscriptions, $this->data['GestionnairePaiement']['mode']);

			if($this->data['GestionnairePaiement']['mode'] != PAYPAL) {
				//On redirige l'utilisateur vers le gestionnaire des paiements
				$this->redirect(array('controller' => 'gestionnaire_paiement', 'action' => 'index'));
			}
			else {
				$parametre_url = implode($inscriptions, '/');
				$return_url = Router::url(array("controller" => "gestionnaire_paiement", "action" => "fin_paypal", $parametre_url), true);
				$cancel_url = Router::url(array("controller" => "gestionnaire_paiement", "action" => "annuler_paypal", $parametre_url), true);
				
				$item_name = __('Paiement pour ', true);
				
				$enfants = $this->Inscription->find('all', array('conditions' => array('Inscription.id' => $inscriptions)));
				foreach($enfants as $enfant) {
					$item_name .= $enfant['Enfant']['prenom'].' '.$enfant['Enfant']['nom'].', ';
				}
				$item_name = trim($item_name, ', ');
				
				$this->Adulte->id = $adulte_id;
				$adulte = $this->Adulte->read();
				$item_name .= __(' de ', true). $adulte['Adulte']['prenom']. ' '. $adulte['Adulte']['nom'];
				
				$paypal = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RFLV92NM77GPL&amount=$montant_total&return=$return_url&rm=1&cancel_return=$cancel_url&item_name=".  urlencode($item_name);
				$this->redirect($paypal);
			}
		} else {
			$this->loadModel('PaiementInscription');
			$versements = $this->PaiementInscription->getTarifs();

			$nb_inscription_paye = $this->PaiementInscription->getNbInscriptionPayé($adulte_id);
			$inscriptions = $this->PaiementInscription->getInscriptionNonPayé($adulte_id);

			$this->set('versements', $versements);

			$this->set('nb_inscription_paye', $nb_inscription_paye);
			$this->set('inscriptions', $inscriptions);
		}
	}
	
	function fin_paypal() {
		$this->set('titre', __('Fin du paiement Paypal', true));
		$this->set('ariane', __('Gestionaire de paiements > Effectuer un paiement > Fin du paiement Paypal', true));
		
		$inscriptions_id = func_get_args();
		$inscriptions = $this->Inscription->find('all', array('recursive' => 2, 'conditions' => array('Inscription.id' => $inscriptions_id)));
		
		foreach($inscriptions as $inscription) {
			$paiements = $inscription['Facture'][0]['Paiement'];
			foreach($paiements as $paiement) {
				$this->Paiement->id = $paiement['id'];
				$this->Paiement->save(array('date_paiements' => null, 'date_reception' => DboSource::expression('NOW()')));
			}
		}
	}
	
	function annuler_paypal() {
		$this->set('titre', __('Annulation du paiement Paypal', true));
		$this->set('ariane', __('Gestionaire de paiements > Effectuer un paiement > Annulation du paiement Paypal', true));
		
		$inscriptions_id = func_get_args();
		$inscriptions = $this->Inscription->find('all', array('recursive' => 2, 'conditions' => array('Inscription.id' => $inscriptions_id)));
		
		foreach($inscriptions as $inscription) {
			$paiements = $inscription['Facture'][0]['Paiement'];
			foreach ($paiements as $paiement) {
					$this->Paiement->delete($paiement['id']);
			}
			$this->Facture->delete($inscription['Facture'][0]['id']);
		}
	}
	
}
