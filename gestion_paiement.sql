

SELECT
	Enfant.nom,
	Enfant.prenom
FROM
	inscriptions Inscription
		JOIN enfants Enfant
			ON Inscription.enfant_id = Enfant.id
		JOIN factures Facture
			ON Inscription.id = Facture.inscription_id;
		
