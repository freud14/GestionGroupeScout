<?php

define('AUCUN_MODE', 0);
define('ARGENT', 1);
define('PAYPAL', 2);
define('CHEQUE', 3);
define('CHEQUES_POSTDATES', 4);
define('PAYPAL_DIFFERE', 5);

/**
 * Cette classe sert à gérer les paiements par les administrateur
 * du système.
 */
class PaiementMembreController extends AppController {

	/**
	 * Le nom du contrôleur
	 * @var string
	 */
	var $name = 'PaiementMembre';

	/**
	 * Les différents Helpers utilisés par le contrôleur et la vue.
	 * @var array
	 */
	var $helpers = array("Html", 'Form');

	/**
	 * Les composants utilisés par le contrôleur.
	 * @var array 
	 */
	var $components = array('InformationPaiement');

	/**
	 * Cette méthode initialise le contrôleur.
	 */
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'admin';
		setlocale(LC_ALL, 'fr_CA.utf8');
		$this->set('title_for_layout', __('Gestion des paiements', true));
	}

	/**
	 * Cette méthode initialise la page pour le statut de paiement
	 * des membres. Elle gère également s'il y a eu une recherche.
	 */
	function index() {
		$this->set('titre', __('Gestion des paiements', true));
		$this->set('ariane', __('Gestion des paiements', true));

		$recherche = NULL;
		if (!empty($this->data)) {
			if (isset($this->data['PaiementMembre']['recherche']) && !empty($this->data['PaiementMembre']['recherche'])) {
				$recherche = $this->data['PaiementMembre']['recherche'];
			}
		}

		if ($recherche != NULL) {
			$this->set('recherche', $recherche);
		}

		$this->set('statuts', $this->PaiementMembre->getStatutPaiementMembre($recherche));
	}

	/**
	 * Cette méthode initialise et gère la page pour modifier le statut
	 * du paiement pour une inscription pour un enfant.
	 * @param type $inscription_id L'id de l'inscription à payer
	 */
	function payer($inscription_id, $adulte_id) {
		$this->set('titre', __('Mise à jour du statut d\'un paiement', true));
		$this->set('ariane', __('Gestion des paiements > Mise à jour du statut d\'un paiement', true));
		$this->loadModel('Paiement');
		$this->loadModel('Facture');
		
		$paiements = $this->PaiementMembre->getPaiementsPourInscription($inscription_id, $adulte_id);
		pr($paiements);

		if (isset($this->data) && !empty($this->data)) {
			pr($this->data);
			
			/*$nouveauModePaiement = $this->data['PaiementMembre']['mode'];
			//Si le mode de paiement reste le même, on a qu'à modifier les paiements actuels
			if ($nouveauModePaiement == $paiements[0]['Paiement']['paiement_type_id']) {
				if ($nouveauModePaiement == ARGENT || $nouveauModePaiement == CHEQUE) {
					if ($nouveauModePaiement == ARGENT) {
						$etat = $this->data['PaiementMembre']['argent'];
					} else {
						$etat = $this->data['PaiementMembre']['cheque'];
					}
					
					$this->_modifierPaiement($paiements, $etat);
				} else if ($nouveauModePaiement == CHEQUES_POSTDATES) {
					$cles = preg_grep('/^cheque([0-9]+)$/', array_keys($this->data['PaiementMembre']));
					$etats = array();
					foreach($cles as $cle) {
						$etats[] = $this->data['PaiementMembre'][$cle];
					}
					$this->_modifierPaiement($paiements, $etats);
				}
			}
			//Sinon, il faut supprimer les paiements actuels s'ils existent et en créer de nouveau.
			else {
				
			}*/
			
			$nouveauModePaiement = $this->data['PaiementMembre']['mode'];
			if ($nouveauModePaiement != $paiements[0]['Paiement']['paiement_type_id']) {
				//Suppression
				foreach ($paiements as $paiement) {
					$this->Paiement->delete($paiement['Paiement']['id']);
				}
				$this->Facture->delete($paiements[0]['Facture']['id']);
				
				//Création des nouveaux paiements
				$fraterie = $paiements[0]['Fraterie']['position'];
				$this->InformationPaiement->créerPaiements($adulte_id, $inscription_id, $nouveauModePaiement, $fraterie);
				
				//Chargement des nouveaux paiements en mémoire
				$paiements = $this->PaiementMembre->getPaiementsPourInscription($inscription_id, $adulte_id);
				pr($paiements);
			}

			//On modifie les informations de paiements
			if ($nouveauModePaiement == ARGENT || $nouveauModePaiement == CHEQUE) {
				if ($nouveauModePaiement == ARGENT) {
					$etat = $this->data['PaiementMembre']['argent'];
				} else {
					$etat = $this->data['PaiementMembre']['cheque'];
				}

				$this->_modifierPaiement($paiements, $etat);
			} else if ($nouveauModePaiement == CHEQUES_POSTDATES) {
				$cles = preg_grep('/^cheque([0-9]+)$/', array_keys($this->data['PaiementMembre']));
				$etats = array();
				foreach ($cles as $cle) {
					$etats[] = $this->data['PaiementMembre'][$cle];
				}
				$this->_modifierPaiement($paiements, $etats);
			}
		} //else {
			$montant = 0;
			if (!empty($paiements[0]['Paiement']['id'])) {
				foreach ($paiements as $paiement) {
					$montant += $paiement['Paiement']['montant'];
				}

				$this->set('type_paiement', $paiements[0]['Paiement']['paiement_type_id']);
			} else {
				$montant = $this->PaiementMembre->getTarifsPossibles($inscription_id, $adulte_id);
				$this->set('type_paiement', AUCUN_MODE);
			}

			$this->loadModel('Versement');
			$this->set('versements', $this->Versement->find('all', array('conditions' => 'Versement.date IS NOT NULL', 'fields' => 'DISTINCT Versement.date', 'order' => 'Versement.date')));


			$this->set('inscription', $paiements[0]);
			$this->set('montant', $montant);

			$this->set('paiements', $paiements);

			$this->set('inscription_id', $inscription_id);
			$this->set('adulte_id', $adulte_id);
		//}
	}

	function _modifierPaiement(&$paiements, $etats) {
		$etats = (array) $etats;
		$i = 0;
		foreach ($etats as $etat) {
			$date_reception = $paiements[$i]['Paiement']['date_reception'];
			$date_paiements = $paiements[$i]['Paiement']['date_paiements'];

			if ($etat == 'non_recu') {
				$date_reception = null;
				$date_paiements = null;
			} else if ($etat == 'recu') {
				if ($paiements[$i]['Paiement']['date_reception'] == '') {
					$date_reception = DboSource::expression('NOW()');
					$date_paiements = null;
				}
			} else if ($etat == 'paye') {
				if ($paiements[$i]['Paiement']['date_reception'] == '') {
					$date_reception = DboSource::expression('NOW()');
				}
				if ($paiements[$i]['Paiement']['date_paiements'] == '') {
					$date_paiements = DboSource::expression('NOW()');
				}
			}

			$this->Paiement->id = $paiements[$i]['Paiement']['id'];
			$this->Paiement->save(array('date_paiements' => $date_paiements, 'date_reception' => $date_reception));

			++$i;
		}
	}

}

?>
