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
	var $components = array('InformationPaiement', 'Email');

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

		if (isset($this->data) && !empty($this->data)) {
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
			}

			//On modifie les informations de paiements
			if ($nouveauModePaiement == ARGENT || $nouveauModePaiement == CHEQUE || $nouveauModePaiement == PAYPAL) {
				if ($nouveauModePaiement == ARGENT) {
					$etat = $this->data['PaiementMembre']['argent'];
				} else if ($nouveauModePaiement == CHEQUE) {
					$etat = $this->data['PaiementMembre']['cheque'];
				} else if ($nouveauModePaiement == PAYPAL) {
					$etat = $this->data['PaiementMembre']['paypal'];
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

			$this->redirect(array('controller' => 'gestionnaire_paiement', 'action' => 'index', $adulte_id));
		} else {
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
		}
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
				else if ($paiements[$i]['Paiement']['date_paiements'] != '') {
					$date_reception = $paiements[$i]['Paiement']['date_reception'];
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

	/**
	 * Cette fonctionde générer les reçcus d'impôt dans la view
	 * @param $id_compte le compte concerner pour les recus
	 */
	public function courriel($adulte_id) {

		$this->layout = 'blank';
		$this->set('title_for_layout', __('Reçu d\'impôt', true));
		$this->set('titre', __('Reçu d\'impôt', true));
		$this->set('ariane', __('Gestion des paiements > Reçu d\'impôt', true));

		$this->set('adulte_id', $adulte_id);
		$this->set('rapport', $this->PaiementMembre->getRapportImpot($adulte_id));

		//Action spécifique selon le bouton
		if (array_key_exists('courriel', $this->params['form'])) {
			$this->_envoyerCourriel($adulte_id);
		}
	}

	/**
	 * Cette fonction permet d'envoyer des recus d'impôt par email
	 * @param $id_compte le compte concerner pour les recus
	 */
	private function _envoyerCourriel($adulte_id) {

		/* On prépare les option SMTP pour le courriel à partir d'une adresse gmail */
		$this->Email->smtpOptions = array(
			'port' => '465',
			'timeout' => '30',
			'host' => 'ssl://smtp.gmail.com',
			'username' => '102e.groupe@gmail.com',
			'password' => 'groupePS102',
		);


		//Recherche des informations du recu d'impot
		$rapport = $this->PaiementMembre->getRapportImpot($adulte_id);

		pr($rapport);
		//Type de livraison
		$this->Email->delivery = 'smtp';

		//On met le email a vide 
		$this->Email->reset();


		//On met les informations nécessaires pour le emails
		$this->Email->from = '102e groupe des Laurentides ';
		$this->Email->to = $rapport[0]['comptes']['nom_utilisateur'];
		//$this->Email->to = 'fredy_14@live.fr';
		$this->Email->bcc = array('102e.groupe@gmail.com');
		$this->Email->subject = __('Reçut d\'impôt pour ', true) . $rapport[0][0]['adulte_nom'];
		$this->set('rapport', $rapport);
		//Le template du email
		$this->Email->template = "recu_impot";
		$this->Email->sendAs = 'html';

		$this->Email->send();

		/* permet d'afficher les erreurs dans le emails si le template ne marche pas
		  if ($this->Email->send()) {
		  return true;
		  } else {
		  echo $this->Email->smtpError;
		  } */

		$this->redirect(array('controller' => 'paiement_membre', 'action' => 'index'));
	}

}

?>
