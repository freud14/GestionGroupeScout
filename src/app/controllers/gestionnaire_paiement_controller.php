<?php

class GestionnairePaiementController extends AppController {

	var $name = 'GestionnairePaiement';
	var $helpers = array("Html", 'Form');

	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		setlocale(LC_ALL, 'fr_CA.utf8');
		$this->set('title_for_layout', __('Gestionaire de paiements', true));
	}

	function index($id = NULL) {
		if ($id == NULL) {
			$this->set('titre', __('Gestionaire de paiements', true));
			$this->set('ariane', __('Gestionaire de paiements', true));

			$id_adulte = 1;
			$this->set('inscriptions', $this->GestionnairePaiement->getInscriptions($id_adulte));
		} else {
			$this->layout = 'admin';
			$this->set('title_for_layout', __('Gestion des paiements', true));
			$this->set('titre', __('Statut du paiement', true));
			$this->set('ariane', __('Gestion des paiements > Statut du paiement', true));

			$this->set('inscriptions', $this->GestionnairePaiement->getInscriptions($id));
			$this->set('admin', true);
		}
	}

	function effectuer_paiement() {
		$this->set('titre', __('Effectuer un paiement', true));
		$this->set('ariane', __('Gestionaire de paiements > Effectuer un paiement', true));

		$id_adulte = 1;

		//$this->loadModel('Versement');
		//$versements = $this->Versement->find('all', array('conditions' => 'NbVersement.nb_versements = 1'/*, 'recursive' => 2*/,'order' => array('Fraterie.position', 'Versement.position')));

		$versements = $this->GestionnairePaiement->getTarifs();
		//pr($versements);

		$nb_inscription_paye = $this->GestionnairePaiement->getNbInscriptionPayé($id_adulte);
		$inscriptions = $this->GestionnairePaiement->getInscriptionNonPayé($id_adulte);


		if (!empty($this->data)) {
			//On trouve la fraterie de la première nouvelle inscription
			$indexProchainVersement = 0;
			for ($i = 0; $i < count($versements); ++$i) {
				$indexProchainVersement = $i;

				//Si la position de la fraterie actuel correspond au nombre d'inscription actuel + 1.
				if ($versements[$i]['Fraterie']['position'] == $nb_inscription_paye + 1) {
					break;
				}
				// S'il manque une position dans la fraterie, on prend la précédente
				else if ($versements[$i]['Fraterie']['position'] > $nb_inscription_paye + 1) {
					--$indexProchainVersement;
					break;
				}
			}

			//On trouve les versements de chacune des inscriptions
			$idModePaiement = $this->data['GestionnairePaiement']['mode'];
			$position = $nb_inscription_paye + 1;
			$inscriptionAPayer = array();
			foreach ($inscriptions as $inscription) {
				//On regarde si on veut payer pour l'inscription.
				if (array_key_exists('inscription' . $inscription['Inscription']['id'], $this->data['GestionnairePaiement']) &&
						$this->data['GestionnairePaiement']['inscription' . $inscription['Inscription']['id']] == $inscription['Inscription']['id']) {

					//Les modes de paiement à un versement ont un id entre 1 et 3.
					if ($idModePaiement >= 1 && $idModePaiement <= 3) {
						$inscriptionAPayer[$inscription['Inscription']['id']][] = $versements[$indexProchainVersement]['Versement'];
					}
					//Les modes de paiement à plusieurs versements ont un id entre 4 et 5.
					else {
						$inscriptionAPayer[$inscription['Inscription']['id']] = $versements[$indexProchainVersement]['Tarifs'];
					}

					//On augmente la position dans la famille
					++$position;

					//On regarde si on passe à la prochaine fraterie
					if ($position > $versements[$indexProchainVersement]['Fraterie']['position'] &&
							$indexProchainVersement < count($versements) - 1) {
						++$indexProchainVersement;
					}
				}
			}

			//On crée nos factures
			$this->loadModel('Facture');
			$this->loadModel('Paiement');
			foreach ($inscriptionAPayer as $idInscription => $versement) {
				$this->Facture->create();
				$insert = array('no_facture' => 'a', 'date_facturation' => DboSource::expression('NOW()'), 'inscription_id' => $idInscription, 'nb_versement_id' => $versement[0]['nb_versement_id'], 'fraterie_id' => $versement[0]['fraterie_id'], 'paiement_type_id' => $idModePaiement);
				$this->Facture->save($insert);

				$idFacture = $this->Facture->id;
				foreach ($versement as $paiement) {
					$this->Paiement->create();
					$insert = array('montant' => $paiement['montant'], 'facture_id' => $idFacture, 'paiement_type_id' => $idModePaiement);
					$this->Paiement->save($insert);
				}
			}

			//On redirige l'utilisateur vers le gestionnaire des paiements
			$this->redirect(array('controller' => 'gestionnaire_paiement', 'action' => 'index'));
		}
		//else {
		$this->set('versements', $versements);

		$this->set('nb_inscription_paye', $nb_inscription_paye);
		$this->set('inscriptions', $inscriptions);
		//}
	}

}

?>
