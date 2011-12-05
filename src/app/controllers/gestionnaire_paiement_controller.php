<?php

/**
 * Cette classe gère la gestion des paiements pour
 * les parents.
 * @author Frédérik Paradis
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
		//Si aucun id est passé, on affiche les enfants de l'utilisateur courrant
		if ($adulte_id == NULL) {
			$this->set('titre', __('Gestionaire de paiements', true));
			$this->set('ariane', __('Gestionaire de paiements', true));

			$adulte_id = $this->Session->read('authentification.id_adulte');
		} else {
			$this->layout = 'admin';
			$this->set('title_for_layout', __('Gestion des paiements', true));
			$this->set('titre', __('Statut du paiement', true));
			$this->set('ariane', __('Gestion des paiements > Statut du paiement', true));

			//On indique à la vue que c'est un administrateur qui veut voir les enfants d'un parent
			$this->set('admin', true);

			$this->set('id_adulte', $adulte_id);
		}
        
		$this->set('inscriptions', $this->GestionnairePaiement->getInscriptions($adulte_id));
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

		//Si on désire retourner vers la gestion des paiements, on redirige l'utilisateur vers la page
		//de gestion des paiements.
		if (array_key_exists('annuler', $this->params['form'])) {
			$this->redirect(array('controller' => 'gestionnaire_paiement', 'action' => 'index'));
		}


		//Si l'utilisateur a validé le paiement et qu'il a choisi un mode de paiement
		if (!empty($this->data) && isset($this->data['GestionnairePaiement']['mode'])) {

			//On prend toutes les inscriptions que l'on désire payer
			$inscriptions = array();
			$keys = preg_grep("/^inscription([0-9]+)$/", array_keys($this->data['GestionnairePaiement']));
			foreach ($keys as $key) {
				if ($this->data['GestionnairePaiement'][$key] != 0) {
					$inscriptions[] = $this->data['GestionnairePaiement'][$key];
				}
			}

			//On crée les paiements et la factures pour les inscriptions voulues.
			$montant_total = $this->InformationPaiement->créerPaiements($adulte_id, $inscriptions, $this->data['GestionnairePaiement']['mode']);

			//Si l'utilisateur n'a pas choisi Paypal, on le redirige vers la page de gestion des paiements.
			if ($this->data['GestionnairePaiement']['mode'] != PAYPAL) {
				//On redirige l'utilisateur vers le gestionnaire des paiements
				$this->redirect(array('controller' => 'gestionnaire_paiement', 'action' => 'index'));
			} else {
				//On redirige l'utilisateur vers Paypal
				$this->_rediriger_paypal($inscriptions, $montant_total, $adulte_id);
			}
		} else {
			//Si l'utilisateur a déjà envoyé le formulaire sans mode de paiement,
			//on indique à la page qu'il y a erreur.
			if (!empty($this->data) && !isset($this->data['GestionnairePaiement']['mode'])) {
				$this->set('aucun_mode_choisi', true);
			}

			//On va chercher les tarifs dans la BD.
			$this->loadModel('PaiementInscription');
			$versements = $this->PaiementInscription->getTarifs();

			//On va chercher le nombre d'inscriptions payés
			$nb_inscription_paye = $this->PaiementInscription->getNbInscriptionPayé($adulte_id);

			//On va chercher les inscriptions non payés.
			$inscriptions = $this->PaiementInscription->getInscriptionNonPayé($adulte_id);

			//On envoie les informations à la vue.
			$this->set('versements', $versements);
			$this->set('nb_inscription_paye', $nb_inscription_paye);
			$this->set('inscriptions', $inscriptions);
		}
	}

	/**
	 * Cette méthode redirige l'utilisateur Paypal avec les
	 * bons paramètres à Paypal.
	 * @param array $inscriptions Les IDs d'inscription des jeunes
	 * @param type $montant_total Le montant total à payer
	 * @param type $adulte_id L'ID de l'adulte concerné.
	 */
	function _rediriger_paypal($inscriptions, $montant_total, $adulte_id) {
		//On crée les URLS de retour et d'annulation de paiement Paypal
		$parametre_url = implode($inscriptions, '/');
		$return_url = Router::url(array("controller" => "gestionnaire_paiement", "action" => "fin_paypal", $parametre_url), true);
		$cancel_url = Router::url(array("controller" => "gestionnaire_paiement", "action" => "annuler_paypal", $parametre_url), true);

		//On nomme l'item Paypal avec le nom des enfants et du parent
		$item_name = __('Paiement pour ', true);

		//On va chercher les noms des enfants dont l'inscription veut être payé.
		$enfants = $this->Inscription->find('all', array('conditions' => array('Inscription.id' => $inscriptions)));
		foreach ($enfants as $enfant) {
			$item_name .= $enfant['Enfant']['prenom'] . ' ' . $enfant['Enfant']['nom'] . ', ';
		}
		$item_name = trim($item_name, ', ');

		//On va cherche le nom de l'adulte.
		$this->Adulte->id = $adulte_id;
		$adulte = $this->Adulte->read();
		$item_name .= __(' de ', true) . $adulte['Adulte']['prenom'] . ' ' . $adulte['Adulte']['nom'];

		//On finalise nos arguements pour l'URL.
		$paypal = sprintf("&amount=%d&return=%s&rm=1&cancel_return=%s&item_name=%s", $montant_total, $return_url, $cancel_url, urlencode(utf8_decode($item_name)));

		//On redirige l'utilisateur vers paypal.
		$this->redirect(PAYPAL_URL . $paypal);
	}

	/**
	 * L'utilisateur est redirigé vers cette page lors de la fin
	 * de son paiement Paypal. Le paiement Paypal de chacune des 
	 * inscriptions passées en paramètre est mis à "Reçu".
	 * @param int ... Nombre variable de nombre entier correspondant
	 * aux IDs d'inscriptions ayant été payés avec Paypal.
	 */
	function fin_paypal() {
		$this->set('titre', __('Fin du paiement Paypal', true));
		$this->set('ariane', __('Gestionaire de paiements > Effectuer un paiement > Fin du paiement Paypal', true));

		//On récupère les IDs d'inscriptions passés en paramètre.
		$inscriptions_id = func_get_args();

		//On récupère les occurences d'inscription de la base de données
		$inscriptions = $this->Inscription->find('all', array('recursive' => 2, 'conditions' => array('Inscription.id' => $inscriptions_id)));

		//On modifie les inscriptions pour les mettre "Reçu".
		foreach ($inscriptions as $inscription) {
			$paiements = $inscription['Facture'][0]['Paiement'];
			foreach ($paiements as $paiement) {
				$this->Paiement->id = $paiement['id'];
				$this->Paiement->save(array('date_paiements' => null, 'date_reception' => DboSource::expression('NOW()')));
			}
		}
	}

	/**
	 * L'utilisateur est redirigé vers cette page lors de l'annulation
	 * de son paiement Paypal. Le paiement Paypal de chacune des 
	 * inscriptions passées en paramètre est supprimé.
	 * @param int ... Nombre variable de nombre entier correspondant
	 * aux IDs d'inscriptions ayant été annulés.
	 */
	function annuler_paypal() {
		$this->set('titre', __('Annulation du paiement Paypal', true));
		$this->set('ariane', __('Gestionaire de paiements > Effectuer un paiement > Annulation du paiement Paypal', true));

		//On récupère les IDs d'inscriptions passés en paramètre.
		$inscriptions_id = func_get_args();

		//On récupère les occurences d'inscription de la base de données
		$inscriptions = $this->Inscription->find('all', array('recursive' => 2, 'conditions' => array('Inscription.id' => $inscriptions_id)));

		foreach ($inscriptions as $inscription) {

			//On supprime chacun des paiements.
			$paiements = $inscription['Facture'][0]['Paiement'];
			foreach ($paiements as $paiement) {
				$this->Paiement->delete($paiement['id']);
			}

			//On supprime la facture concernée.
			$this->Facture->delete($inscription['Facture'][0]['id']);
		}
	}

}
