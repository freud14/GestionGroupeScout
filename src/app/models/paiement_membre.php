<?php

App::import('Sanitize');

/**
 * Cette classe sert de modèle pour la gestion des
 * paiements des membres par les administrateurs.
 * @author
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
		//On regarde si l'utilisateur a effectuée une recherche
		$conditions = "";
		if ($recherche != NULL) {
			$recherche = Sanitize::escape($recherche); //On protège des injections SQL.
			$recherche = str_replace(array("%", "_"), array("\%", "\_"), $recherche);
			$conditions = "AND 
						Adulte.nom LIKE '%$recherche%' OR 
						Adulte.prenom LIKE '%$recherche%' OR
						CONCAT(Adulte.prenom, ' ', Adulte.nom) LIKE '%$recherche%' OR 
						CONCAT(Adulte.nom, ' ', Adulte.prenom) LIKE '%$recherche%'";
		}

		return h($this->query("SELECT
								Adulte.id,
								Adulte.nom,
								Adulte.prenom,
								Adulte.courriel,
								Adulte.tel_maison,
								COUNT(inscriptions.id) AS nb_inscriptions, #On compte le nombre d'inscription
								COUNT(paiements.id) AS nb_paiement, #On compte le nombre de paiement
								COUNT(paiements.date_reception) AS nb_paiement_recu, #On compte le nombre de paiements reçus.
								COUNT(paiements.date_paiements) AS nb_paiement_encaisse #On trouve le nombre de paiements payés
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
								annees.date_fin IS NULL  #Pour l'année actuelle
								$conditions
							GROUP BY
								Adulte.id,
								Adulte.nom,
								Adulte.prenom,
								Adulte.courriel,
								Adulte.tel_maison;", false), ENT_NOQUOTES);
	}

	/**
	 * Cette méthode retourne les informations de paiement
	 * pour une inscription selon un parent.
	 * @param int $inscription_id L'ID de l'inscription concernée.
	 * @param int $adulte_id L'ID de l'adulte concerné.
	 * @return array Retourne les informations de paiement
	 * pour une inscription selon un parent.
	 */
	function getPaiementsPourInscription($inscription_id, $adulte_id) {
		return h($this->query('SELECT
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
													adultes.id = ' . intval($adulte_id) . ' #Pour l\'adulte concerné
									LEFT JOIN factures Facture
										ON Inscription.id = Facture.inscription_id
										LEFT JOIN frateries Fraterie
											ON Facture.fraterie_id = Fraterie.id
										LEFT JOIN paiements Paiement
											ON Facture.id = Paiement.facture_id
                                    JOIN annees
                                        ON inscriptions.annee_id = annees.id
							WHERE
								annees.date_fin IS NULL AND #Pour l\'année actuelle
								Inscription.id = ' . intval($inscription_id) . ' #Pour l\'inscription voulue
							ORDER BY
								Paiement.ordre_paiement #On ordonne par l\'ordre de paiement 
								;', false), ENT_NOQUOTES);
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

		$inscriptions_id = (array) $inscriptions_id;

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

	/**
	 * Cette méthode retourne le recu d'impot d'un membre
	 * @param int $compte_id l'id du compte
	 * @return array Retourne les données sous forme de tableau.
	 * @author Luc-Frédéric Langis
	 * @author Frédérik Paradis
	 */
	function getRapportImpot($adulte_id) {
		return h($this->query('	SELECT
									adultes.courriel,
									inscriptions.id,
									factures.id,
									enfants.date_naissance,
									CONCAT(enfants.prenom, " ", enfants.nom) AS enfant_nom,
									CONCAT(adultes.prenom," ", adultes.nom) AS adulte_nom,
									CONCAT(adresses.adresses,", ", adresses.ville, "(Québec), ", adresses.code_postal) as adresse,
									SUM(paiements.montant) AS montant_total, #On additionne les montants des paiements
									unites.nom,
									CURDATE() AS date 
								FROM
									adultes
										LEFT JOIN adultes_enfants
											ON adultes.id = adultes_enfants.adulte_id
											LEFT JOIN enfants
												ON adultes_enfants.enfant_id = enfants.id
												LEFT JOIN adresses
													ON enfants.adresse_id = adresses.id
											LEFT JOIN inscriptions
												ON enfants.id = inscriptions.enfant_id
												LEFT JOIN unites
													ON inscriptions.unite_id = unites.id
												LEFT JOIN factures
													ON inscriptions.id = factures.inscription_id
													LEFT JOIN paiements
														ON factures.id = paiements.facture_id
                                                JOIN annees
                                                    ON inscriptions.annee_id = annees.id
								WHERE
									((inscriptions.date_fin IS NULL AND #Pour les inscriptions actuelles
									annees.date_fin IS NULL) OR #Pour l\'année actuel
									inscriptions.id IS NULL) AND  
									adultes.id = ' . intval($adulte_id) . ' AND
									factures.id IS NOT NULL #Pour les inscriptions dont les paiements sont générés.
								GROUP BY
									adultes.id,
									enfants.id,
									inscriptions.id
								ORDER BY
									inscriptions.id;'), ENT_NOQUOTES);
	}

}

?>
