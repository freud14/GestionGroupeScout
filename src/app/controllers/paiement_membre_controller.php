<?php

/**
 * Cette classe sert à gérer les paiements par les administrateur
 * du système.
 */
class PaiementMembreController extends AppController {

	/**
	 * Le nom du contrôleur
	 * @var type string
	 */
	var $name = 'PaiementMembre';
	
	/**
	 * Les différents Helpers utilisés par le contrôleur et la vue.
	 * @var type array
	 */
	var $helpers = array("Html", 'Form');

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
	function payer($inscription_id) {
		$this->set('titre', __('Mise à jour du statut d\'un paiement', true));
		$this->set('ariane', __('Gestion des paiements > Mise à jour du statut d\'un paiement', true));
		if (isset($this->data) && !empty($this->data)) {
			
		} else {
			
		}
	}

}

?>
