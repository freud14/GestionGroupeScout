<?php

App::import('Sanitize');

/**
 * Cette classe sert de modèle pour la gestion des
 * paiements des membres par les administrateurs.
 */
class PaiementMembre extends AppModel {

	/**
	 * Le nom du modèle
	 * @var string 
	 */
	var $name = 'PaiementMembre';

	/**
	 * @var bool
	 */
	var $useTable = false;

	/**
	 * Cette méthode récupère le statut du 
	 * paiement de tous les membres.
	 * @param string $recherche Critère de recherche pour les membres.
	 * @return array Retourne le statut du paiement de tous 
	 * les membres.
	 */
	function getStatutPaiementMembre($recherche = NULL) {
		$conditions = "";
		if ($recherche != NULL) {
			$recherche = Sanitize::escape($recherche);
			$recherche = str_replace(array("%", "_"), array("\%", "\_"), $recherche);
			$conditions = "AND 
						Adulte.nom LIKE '%$recherche%' OR 
						Adulte.prenom LIKE '%$recherche%' OR
						CONCAT(Adulte.prenom, ' ', Adulte.nom) LIKE '%$recherche%' OR 
						CONCAT(Adulte.nom, ' ', Adulte.prenom) LIKE '%$recherche%'";
		}

		return $this->query("SELECT
								Adulte.id,
								Adulte.nom,
								Adulte.prenom,
								Adulte.courriel,
								Adulte.tel_maison,
								COUNT(inscriptions.id) AS nb_inscriptions,
								COUNT(paiements.id) AS nb_paiement,
								COUNT(paiements.date_reception) AS nb_paiement_recu,
								COUNT(paiements.date_paiements) AS nb_paiement_encaisse
							FROM
								adultes Adulte
									JOIN adultes_enfants
										ON adultes_enfants.adulte_id = Adulte.id
											JOIN enfants
												ON adultes_enfants.enfant_id = enfants.id
													JOIN inscriptions
														ON inscriptions.enfant_id = enfants.id
															LEFT JOIN factures
																ON inscriptions.id = factures.inscription_id
																	LEFT JOIN paiements
																		ON factures.id = paiements.facture_id
													JOIN annees
														ON inscriptions.annee_id = annees.id
							WHERE
								inscriptions.date_fin IS NULL AND
								annees.date_fin IS NULL $conditions
							GROUP BY
								Adulte.id,
								Adulte.nom,
								Adulte.prenom,
								Adulte.courriel,
								Adulte.tel_maison;", false);
	}
	
	function getPaiementsPourInscription($inscription_id, $adulte_id) {
		return $this->query('SELECT
								Enfant.prenom,
								Enfant.nom,
								Facture.id,
								Facture.fraterie_id,
								Inscription.id,
								Paiement.id,
								Paiement.montant,
								Paiement.paiement_type_id,
								Paiement.date_reception,
								Paiement.date_paiements,
								Fraterie.position
							FROM
								inscriptions Inscription
									JOIN enfants Enfant
										ON	Inscription.enfant_id = Enfant.id
										LEFT JOIN adultes_enfants
											ON adultes_enfants.enfant_id = Enfant.id
											JOIN adultes
												ON 	adultes_enfants.adulte_id = adultes.id AND
													adultes.id = '.intval($adulte_id).'
									LEFT JOIN factures Facture
										ON Inscription.id = Facture.inscription_id
										LEFT JOIN frateries Fraterie
											ON Facture.fraterie_id = Fraterie.id
										LEFT JOIN paiements Paiement
											ON Facture.id = Paiement.facture_id
							WHERE
								Inscription.annee_id = (SELECT id FROM annees ORDER BY date_debut LIMIT 1,1) AND
								Inscription.id = '.intval($inscription_id).'
							ORDER BY
								Paiement.ordre_paiement;', false);
	}

	/**
	 * Cette méthode sert à savoir un prix possible de l'inscription 
	 * selon la fraterie des inscriptions. 
	 * @param array|int $inscriptions_id Un tableau ou un entier correspondant
	 * à un ID d'inscription dans la BD.
	 * @param int $adulte_id L'ID de l'adulte
	 * @return array|int Retourne un tableau ou un entier correspondant
	 * au prix possible de l'inscription selon la fraterie des inscriptions.
	 */
	function getTarifsPossibles($inscriptions_id, $adulte_id) {
		$versements = ClassRegistry::init('PaiementInscription')->getTarifs();
		$nb_inscription_paye = ClassRegistry::init('PaiementInscription')->getNbInscriptionPayé($adulte_id);
		$inscriptions = ClassRegistry::init('PaiementInscription')->getInscriptionNonPayé($adulte_id);

		$inscriptions_id = (array)$inscriptions_id;
		
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
		$position = $nb_inscription_paye + 1;
		$inscriptionAPayer = array();
		foreach ($inscriptions as $inscription) {
			//On regarde si on veut payer pour l'inscription.
			if (in_array($inscription['Inscription']['id'], $inscriptions_id)) {
				//Les modes de paiement à un versement ont un id entre 1 et 3.
				$inscriptionAPayer[] = $versements[$indexProchainVersement]['Versement']['montant'];

				//On augmente la position dans la famille
				++$position;

				//On regarde si on passe à la prochaine fraterie
				if ($position > $versements[$indexProchainVersement]['Fraterie']['position'] &&
						$indexProchainVersement < count($versements) - 1) {
					++$indexProchainVersement;
				}
			}
		}

		return count($inscriptionAPayer) == 1 ? $inscriptionAPayer[0] : $inscriptionAPayer;
	}

}

?>
