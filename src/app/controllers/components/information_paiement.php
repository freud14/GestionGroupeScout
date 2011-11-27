<?php

/**
 * Cette classe sert à gérer 
 */
class InformationPaiementComponent extends Object {

	var $PaiementInscription;
	var $Facture;
	var $Paiement;

	/**
	 * Le constructeur initialise l'objet.
	 */
	function __construct() {
		parent::__construct();
		$this->PaiementInscription = ClassRegistry::init('PaiementInscription');
		$this->Facture = ClassRegistry::init('Facture');
		$this->Paiement = ClassRegistry::init('Paiement');
	}

	/**
	 * Cette méthode sert à créer la facture et les paiements de base
	 * d'une ou plusieurs inscriptions.
	 * @param int $adulte_id L'adulte dont on veut modifier les inscriptions
	 * @param array|int $inscriptions_id Les IDs d'inscriptions
	 * @param int $mode_paiement Le mode de paiement des inscriptions
	 * @return Retourne le montant total qui est facturé.
	 */
	function créerPaiements($adulte_id, $inscriptions_id, $mode_paiement, $fraterie = null) {
		$versements = $this->PaiementInscription->getTarifs();

		//Si l'utilisateur a spécifié une fraterie, on la prend sinon on la trouve.
		$fraterie = $fraterie == null ? $this->PaiementInscription->getNbInscriptionPayé($adulte_id) + 1 : $fraterie;
		$inscriptions = $this->PaiementInscription->getInscriptionNonPayé($adulte_id);

		$inscriptions_id = (array) $inscriptions_id;

		//On trouve la fraterie de la première nouvelle inscription
		$indexProchainVersement = 0;
		for ($i = 0; $i < count($versements); ++$i) {
			$indexProchainVersement = $i;

			//Si la position de la fraterie actuel correspond au nombre d'inscription actuel + 1.
			if ($versements[$i]['Fraterie']['position'] == $fraterie) {
				break;
			}
			// S'il manque une position dans la fraterie, on prend la précédente
			else if ($versements[$i]['Fraterie']['position'] > $fraterie) {
				--$indexProchainVersement;
				break;
			}
		}

		//On trouve les versements de chacune des inscriptions
		$position = $fraterie;
		$inscriptionAPayer = array();
		foreach ($inscriptions as $inscription) {
			//On regarde si on veut payer pour l'inscription.
			if (in_array($inscription['Inscription']['id'], $inscriptions_id)) {
				//Les modes de paiement à un versement ont un id entre 1 et 3.
				if ($mode_paiement >= 1 && $mode_paiement <= 3) {
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

		$montant_total = 0;
		//On crée nos factures
		foreach ($inscriptionAPayer as $idInscription => $versement) {
			$this->Facture->create();
			$insert = array('no_facture' => 'a',
				'date_facturation' => DboSource::expression('NOW()'),
				'inscription_id' => $idInscription,
				'nb_versement_id' => $versement[0]['nb_versement_id'],
				'fraterie_id' => $versement[0]['fraterie_id']);
			$this->Facture->save($insert);

			$i = 1;
			$idFacture = $this->Facture->id;
			foreach ($versement as $paiement) {
				$this->Paiement->create();
				$insert = array('montant' => $paiement['montant'], 'facture_id' => $idFacture, 'paiement_type_id' => $mode_paiement, 'ordre_paiement' => $i);
				$this->Paiement->save($insert);
				$montant_total += $paiement['montant'];
				++$i;
			}
		}
		
		return $montant_total;
	}

}
?>

