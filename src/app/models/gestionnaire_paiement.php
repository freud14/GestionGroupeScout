<?php

/**
 * Cette classe permet de récupérer les données
 * de paiements des membres.
 */
class GestionnairePaiement extends AppModel {

	/**
	 * Le nom du modèle
	 * @var string
	 */
	var $name = 'GestionnairePaiement';

	/**
	 * Booléen de CakePHP indiquant les tables 
	 * utilisées par le modèle.
	 * @var bool 
	 */
	var $useTable = false;

	/**
	 * Cette méthode retourne le statut de paiement pour
	 * un membre.
	 * @param int $adulte_id L'id de l'adulte du membre.
	 * @return array Retourne les données sous forme de tableau.
	 */
	function getInscriptions($adulte_id) {
		return $this->query('	SELECT
						inscriptions.id,
						CONCAT(enfants.prenom, " ", enfants.nom) AS enfant_nom,
						paiement_types.nom AS type_paiement,
						SUM(IF(date_paiements IS NOT NULL, paiements.montant, 0)) AS montant_paye,
						SUM(paiements.montant) AS montant_total,
						COUNT(paiements.date_reception) AS nb_recu,
						COUNT(paiements.date_paiements) AS nb_paiement,
						COUNT(paiements.id) AS nb_total_paiement,
						MAX(paiements.date_paiements) AS dernier_paiement,
						IF(SUM(COALESCE(paiements.montant, 0)) != SUM(IF(date_paiements IS NOT NULL, paiements.montant, 0)),
							(SELECT 
								MIN(prochain_versement.date)
							FROM 
								versements prochain_versement 
							WHERE 
								prochain_versement.date > COALESCE(MAX(paiements.date_paiements), 0)),
							NULL) AS prochain_paiement
					FROM
						inscriptions
							JOIN enfants
								ON inscriptions.enfant_id = enfants.id
								LEFT JOIN adultes_enfants
									ON adultes_enfants.enfant_id = enfants.id
									JOIN adultes
										ON	adultes_enfants.adulte_id = adultes.id AND
											adultes.id = ' . intval($adulte_id) . '
							LEFT JOIN factures
								ON inscriptions.id = factures.inscription_id
								LEFT JOIN frateries
									ON factures.fraterie_id = frateries.id
								LEFT JOIN paiements
									ON factures.id = paiements.facture_id
									LEFT JOIN paiement_types
										ON paiements.paiement_type_id = paiement_types.id
					WHERE 
						inscriptions.date_fin IS NULL AND
						inscriptions.annee_id = (SELECT id FROM annees ORDER BY date_debut LIMIT 1,1)
					GROUP BY
						enfants.prenom,
						enfants.nom,
						paiement_types.nom,
						paiement_types.id,
						inscriptions.date_fin,
						inscriptions.annee_id
					ORDER BY
						frateries.position;', false);
	}


	/**
	 * Cette méthode retourne le recu d'impot d'un membre
	 * @param int $compte_id l'id du compte
	 * @return array Retourne les données sous forme de tableau.
	 */
	function getRapportImpot($compte_id) {
		return $this->query('	SELECT
						comptes.nom_utilisateur,
						inscriptions.id,
						factures.id,
						enfants.date_naissance,
						CONCAT(enfants.prenom, " ", enfants.nom) AS enfant_nom,
						CONCAT(adultes.prenom," ", adultes.nom) AS adulte_nom,
						CONCAT(adresses.adresses,", ", adresses.ville, "(Québec), ", adresses.code_postal) as adresse,
						SUM(paiements.montant) AS montant_total,
						unites.nom,
						CURDATE() AS date
						FROM
							comptes
								JOIN adultes
									ON ' . $compte_id . ' = adultes.compte_id
								JOIN adultes_enfants
									ON adultes_enfants.adulte_id = adultes.id
								JOIN enfants
									ON adultes_enfants.enfant_id = enfants.id
								LEFT JOIN adresses
									ON enfants.adresse_id = adresses.id
								LEFT JOIN inscriptions
									ON enfants.id = inscriptions.enfant_id
								LEFT JOIN unites
									ON inscriptions.unite_id = unites.id
								JOIN factures
									ON inscriptions.id = factures.inscription_id
								LEFT JOIN paiements
									ON factures.id = paiements.facture_id
						WHERE
							inscriptions.date_fin IS NULL AND
							inscriptions.annee_id = (SELECT id FROM annees ORDER BY date_debut LIMIT 1,1)
						GROUP BY
							enfants.prenom,
							enfants.nom,
							adultes.nom,
							inscriptions.date_fin,
							inscriptions.annee_id
						ORDER BY
							inscriptions.id');



	}

}

?>
