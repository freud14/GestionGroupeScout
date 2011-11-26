<?php

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
		$this->loadModel('Inscription');
		$this->loadModel('Annee');
		$this->loadModel('Facture');
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
			$this->InformationPaiement->créerPaiements($adulte_id, $inscriptions, $this->data['GestionnairePaiement']['mode']);

			//On redirige l'utilisateur vers le gestionnaire des paiements
			$this->redirect(array('controller' => 'gestionnaire_paiement', 'action' => 'index'));
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

	/* Cette fonctionde générer les reçcus d'impôt dans la view
	 * @param $id_compte le compte concerner pour les recus
	 */

	public function courriel($id_compte) {
	
			$this->layout = 'admin';
			$this->set('title_for_layout', __('Reçu d\'impôt', true));
			$this->set('titre', __('Reçu d\'impôt', true));
			$this->set('ariane', __('Gestion des paiements > Reçu d\'impôt', true));


		$this->set('rapport', $this->GestionnairePaiement->getRapportImpot(1));

		
		//Action spécifique selon le bouton
		if (array_key_exists('courriel', $this->params['form'])) {
			$this->_envoyerCourriel(1);
		}
	}


	/* Cette fonction permet d'envoyer des recus d'impôt par email
	 * @param $id_compte le compte concerner pour les recus
	 */
	private function _envoyerCourriel($id_compte) {

		/* On prépare les option SMTP pour le courriel à partir d'une adresse gmail */
		$this->Email->smtpOptions = array(
		    'port' => '465',
		    'timeout' => '30',
		    'host' => 'ssl://smtp.gmail.com',
		    'username' => '102e.groupe@gmail.com',
		    'password' => 'groupePS102',
		);

		//Recherche des informations du recu d'impot
		$rapport = $this->GestionnairePaiement->getRapportImpot($id_compte);
		
		//Type de livraison
		$this->Email->delivery = 'smtp';

		//On met le email a vide 
		$this->Email->reset();

		//On met les informations nécessaires pour le emails
		$this->Email->from = '102e groupe des Laurentides ';
		// $this->Email->to = $rapport[0]['comptes']['nom_utilisateur'];
		$this->Email->to = 'fredy_14@live.fr';
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
		}*/
			
		$this->redirect(array('controller' => 'gestionnaire_paiement', 'action' => 'index'));
	}

}
