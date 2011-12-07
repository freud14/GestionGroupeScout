<?php

/**
 * Cette classe sert à gérer les paiements par les administrateur
 * du système.
 * @author Frédérik Paradis
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
        if($this->_getAutorisation() < 3){
            $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
        }
		$this->loadModel('Adulte');
		$this->layout = 'admin';
		$this->set('title_for_layout', __('Gestion des paiements', true));
	}

	/**
	 * Cette méthode initialise la page pour le statut de paiement
	 * des membres. Elle gère également s'il y a eu une recherche.
	 */
	function index() {
		$this->set('titre', __('Gestion des paiements', true));
		$this->set('ariane', __('Gestion des paiements', true));

		//On regarde si l'utilisateur a fait une recherche
		$recherche = NULL;
		if (!empty($this->data)) {
			if (isset($this->data['PaiementMembre']['recherche']) && !empty($this->data['PaiementMembre']['recherche'])) {
				$recherche = $this->data['PaiementMembre']['recherche'];
			}
		}

		//Si oui, on envoit la recherche effectuée à la vue.
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

		//On va chercher le(s) paiement(s) à modifier
		$paiements = $this->PaiementMembre->getPaiementsPourInscription($inscription_id, $adulte_id);

		//Si l'utilisateur veut modifier le statut d'un paiement
		if (isset($this->data) && !empty($this->data)) {
			
			//On prend le mode de paiement choisi
			$nouveauModePaiement = $this->data['PaiementMembre']['mode'];
			
			//On regarde si le mode de paiement choisi est différent du mode de paiement déjà dans le système
			if ($nouveauModePaiement != $paiements[0]['Paiement']['paiement_type_id']) {
				//Si le mode est différent, on supprime les paiements
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
			
			//Si c'est un mode de paiement unique
			if ($nouveauModePaiement == ARGENT || $nouveauModePaiement == CHEQUE || $nouveauModePaiement == PAYPAL) {
				//On regarde l'état voulu du paiement
				if ($nouveauModePaiement == ARGENT) {
					$etat = $this->data['PaiementMembre']['argent'];
				} else if ($nouveauModePaiement == CHEQUE) {
					$etat = $this->data['PaiementMembre']['cheque'];
				} else if ($nouveauModePaiement == PAYPAL) {
					$etat = $this->data['PaiementMembre']['paypal'];
				}

				//On modifie l'état du paiement
				$this->_modifierPaiement($paiements, $etat);
			} else if ($nouveauModePaiement == CHEQUES_POSTDATES) {
				//On va chercher l'état des différents chèques postdatés.
				$cles = preg_grep('/^cheque([0-9]+)$/', array_keys($this->data['PaiementMembre']));
				$etats = array();
				foreach ($cles as $cle) {
					$etats[] = $this->data['PaiementMembre'][$cle];
				}
				
				//On modifie l'état du paiement
				$this->_modifierPaiement($paiements, $etats);
			}

			//On redirige l'utilisateur vers la page du parent dont il vient de modifier le statut du paiement
			$this->redirect(array('controller' => 'gestionnaire_paiement', 'action' => 'index', $adulte_id));
		} else {
			//Le montant à afficher dans la page
			$montant = 0;
			
			//On regarde si l'utilisateur a déjà généré les paiements dans la BD
			if (!empty($paiements[0]['Paiement']['id'])) {
				//Si oui, on trouve le montant déjà alloué pour l'inscription
				foreach ($paiements as $paiement) {
					$montant += $paiement['Paiement']['montant'];
				}

				$this->set('type_paiement', $paiements[0]['Paiement']['paiement_type_id']);
			} else {
				//Sinon, on trouve le tarif possible pour le paiement
				$montant = $this->PaiementMembre->getTarifsPossibles($inscription_id, $adulte_id);
				$this->set('type_paiement', AUCUN_MODE);
			}

			//On trouve les montants des différents versements
			$this->loadModel('Versement');
			$this->set('versements', $this->Versement->find('all', array('conditions' => 'Versement.date IS NOT NULL', 'fields' => 'DISTINCT Versement.date', 'order' => 'Versement.date')));

			//Pour afficher le nom de l'inscription dans la page
			$this->set('inscription', $paiements[0]);
			
			//Le montant de l'inscription
			$this->set('montant', $montant);

			//L'état des paiements
			$this->set('paiements', $paiements);

			//L'ID de l'inscription et de l'adulte concerné
			$this->set('inscription_id', $inscription_id);
			$this->set('adulte_id', $adulte_id);
		}
	}

	/**
	 * Cette méthode sert à modifier le statut des paiements
	 * passés en paramètre.
	 * @param array $paiements L'état des paiements qui sortent 
	 * de la BD.
	 * @param array|int $etats L'état voulu des paiements
	 */
	function _modifierPaiement(&$paiements, $etats) {
		//On caste notre paramètre en tableau parce que cette méthode
		//accepte également un entier pour ce paramètre
		$etats = (array) $etats;
		
		//Cette boucle modifie chacun des paiements par les états voulu.
		$i = 0;
		foreach ($etats as $etat) {
			//On initialise la date de réception et la date de paiement
			//avec les date actuelle.
			$date_reception = $paiements[$i]['Paiement']['date_reception'];
			$date_paiements = $paiements[$i]['Paiement']['date_paiements'];

			//Si l'utilisateur mets le paiement à non reçu, on mets les 
			//deux dates à null.
			if ($etat == 'non_recu') {
				$date_reception = null;
				$date_paiements = null;
			} else if ($etat == 'recu') {
				//Si la date de réception était null, on mets la date actuelle.
				if ($paiements[$i]['Paiement']['date_reception'] == '') {
					$date_reception = DboSource::expression('NOW()');
					$date_paiements = null;
				}
				//Si la date de paiement était à null mais pas la date de réception,
				//on garde la date de réception actuel.
				else if ($paiements[$i]['Paiement']['date_paiements'] != '') {
					$date_reception = $paiements[$i]['Paiement']['date_reception'];
					$date_paiements = null;
				}
			} else if ($etat == 'paye') {
				//Si le paiement était non reçu, on met la date actuel pour la date de réception.
				if ($paiements[$i]['Paiement']['date_reception'] == '') {
					$date_reception = DboSource::expression('NOW()');
				}
				//Si le paiement était non payé, on met la date actuel pour la date de paiement.
				if ($paiements[$i]['Paiement']['date_paiements'] == '') {
					$date_paiements = DboSource::expression('NOW()');
				}
			}

			//On enregistre le paiement avec les nouvelles dates s'il y a lieu
			$this->Paiement->id = $paiements[$i]['Paiement']['id'];
			$this->Paiement->save(array('date_paiements' => $date_paiements, 'date_reception' => $date_reception));

			//On passe au prochain paiement
			++$i;
		}
	}

	/**
	 * Cette fonction perment de générer les reçus d'impôt dans la vue.
	 * @param $id_compte Le compte concerné pour les recus
	 * @author Luc-Frédéric Langis
	 */
	public function courriel($adulte_id) {

		$this->layout = 'blank';

		$this->set('adulte_id', $adulte_id);
		$rapport = $this->PaiementMembre->getRapportImpot($adulte_id);
		if((!isset($rapport)) || (empty($rapport))){
			$rapport = array();
			$rapport = $this->Adulte->find('first', array('conditions' => array('Adulte.id' => $adulte_id)));
		}
		$this->set('rapport', $rapport);
		
		//Action spécifique selon le bouton
		if (array_key_exists('courriel', $this->params['form'])) {
			$this->_envoyerCourriel($adulte_id);
		}else if (array_key_exists('annuler', $this->params['form'])){
			$this->redirect(array('controller' => 'paiement_membre', 'action' => 'index'));
		}
	}

	/**
	 * Cette fonction permet d'envoyer des recus d'impôt par email.
	 * @param $id_compte Le compte concerné pour les recus
	 * @author Luc-Frédéric Langis
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
		
		//Type de livraison
		$this->Email->delivery = 'smtp';

		//On met le email a vide 
		$this->Email->reset();

		//On met les informations nécessaires pour le emails
		$this->Email->from = '102e Groupe scout des Laurentides ';
		$this->Email->to = $rapport[0]['adultes']['courriel'];		
		$this->Email->bcc = array('102e.groupe@gmail.com');
		$this->Email->subject = __('Reçu(s) d\'impôt(s) pour ', true) . $rapport[0][0]['adulte_nom'];
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
