/*
	Permet de trouver le statut des paiements d'un membre.
*/
SELECT
	CONCAT(enfants.prenom, " ", enfants.nom) AS enfant_nom,
	paiement_types.nom AS type_paiement,
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
			prochain_versement.date > COALESCE(MAX(paiements.date_paiements), 0)),
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
							comptes_id = '.intval($id_compte).'*/
		LEFT JOIN factures
			ON inscriptions.id = factures.inscription_id
			LEFT JOIN paiements
				ON factures.id = paiements.facture_id
			LEFT JOIN paiement_types
				ON factures.paiement_type_id = paiement_types.id
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
	versements.montant,
	inscriptions.date_fin,
	inscriptions.annee_id
ORDER BY
	frateries.position;

/*
	Permet de trouver la grille des prix.
*/
SELECT
	frateries.position,
	versements.date,
	versements.montant,
	versements.position,
	nb_versements.nb_versements,
	frateries.id as frateries_id,
	nb_versements.id as nb_versements_id
FROM	
	versements
		JOIN frateries
			ON versements.fraterie_id = frateries.id
		JOIN nb_versements
			ON versements.nb_versement_id = nb_versements.id
ORDER BY
	frateries.position,
	versements.position;

/*
	Permet de trouver les dates des versements.
*/
SELECT 
	DISTINCT versements.date
FROM	
	versements
ORDER BY
	versements.date;

/*
	Permet de sortir le nombre d'enfant déjà payé 
	pour un compte.
*/
SELECT
	COUNT(inscriptions.id) as prochaine_position
FROM
	inscriptions
		JOIN enfants
			ON inscriptions.enfant_id = enfants.id
			JOIN adultes_enfants
				ON enfants.id = adultes_enfants.enfant_id
				JOIN adultes
					ON adultes_enfants.adulte_id = adultes.id
					JOIN comptes
						ON 	adultes.compte_id = comptes.id /*AND
							comptes.id = $id_compte*/
		JOIN factures
			ON factures.inscription_id = inscriptions.id
WHERE 
	inscriptions.date_fin IS NULL AND
	inscriptions.annee_id = (SELECT id FROM annees ORDER BY date_debut LIMIT 1,1);

/*
	Permet de sortir les enfants qui n'ont pas encore de 
	factures pour l'année en cours.
*/
SELECT
	/* comptes.id,
	comptes.nom_utilisateur,*/
	Enfant.id,
	Enfant.nom,
	Enfant.prenom,
	Inscription.id
FROM
	inscriptions Inscription
		JOIN enfants Enfant
			ON Inscription.enfant_id = Enfant.id
			JOIN adultes_enfants
				ON Enfant.id = adultes_enfants.enfant_id
				JOIN adultes
					ON adultes_enfants.adulte_id = adultes.id
					JOIN comptes
						ON 	adultes.compte_id = comptes.id /*AND
							comptes.id = $id_compte*/
		LEFT JOIN factures
			ON factures.inscription_id = Inscription.id
WHERE 
	Inscription.date_fin IS NULL AND
	Inscription.annee_id = (SELECT id FROM annees ORDER BY date_debut LIMIT 1,1) AND
	factures.id IS NULL;



