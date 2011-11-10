SELECT
	CONCAT(enfants.prenom, " ", enfants.nom) AS enfant_nom,
	IF(paiement_types.nom = 'Credit', paiement_types.type_carte, paiement_types.nom) AS type_paiement,
	SUM(COALESCE(paiements.montant, 0)) AS montant_paye,
	versements.montant AS montant_total,
	IF(SUM(COALESCE(paiements.montant, 0)) = versements.montant, 1, 0) AS statut,
	MAX(paiements.date_paiements) AS derniere_date_paiement,
	IF(SUM(COALESCE(paiements.montant, 0)) != versements.montant,
		(SELECT 
			MIN(prochain_versement.date) 
		FROM 
			versements prochain_versement 
		WHERE 
			prochain_versement.date > MAX(paiements.date_paiements)),
		NULL) AS prochain_paiement
FROM
	inscriptions
		JOIN enfants
			ON inscriptions.enfant_id = enfants.id
			LEFT JOIN adultes_enfants
				ON adultes_enfants.enfant_id = enfants.id
				JOIN adultes
					ON adultes_enfants.adulte_id = adultes.id
					JOIN comptes
						ON 	adultes.compte_id = comptes.id /*AND
							comptes_id = $id_compte*/
		LEFT JOIN factures
			ON inscriptions.id = factures.inscription_id
			LEFT JOIN paiements
				ON factures.id = paiements.facture_id
				LEFT JOIN paiement_types
					ON paiements.paiement_type_id = paiement_types.id
			LEFT JOIN frateries
				ON factures.fraterie_id = frateries.id
				LEFT JOIN versements
					ON 	frateries.id = versements.fraterie_id AND
						(SELECT 
							nb_versements.id
						FROM 
							nb_versements 
						WHERE 
							nb_versements.nb_versements = 1) = versements.nb_versement_id
WHERE 
	inscriptions.date_fin IS NULL AND
	inscriptions.annee_id = (SELECT id FROM annees ORDER BY date_debut LIMIT 1,1)
GROUP BY
	enfants.prenom,
	enfants.nom,
	paiement_types.nom, 
	paiement_types.type_carte,
	versements.montant;
