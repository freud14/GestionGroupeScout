<?php
class GestionnairePaiement extends AppModel {
	var $name = 'GestionnairePaiement';
	var $useTable = false;
	
	function getInscriptions($id_compte) {
		return $this->query('	SELECT
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
						versements.montant
					ORDER BY
						frateries.position;');
	}
	
	function getNbInscriptionPayé($id_compte) {
		$retour = $this->query('SELECT
						COUNT(inscriptions.id) as nb_inscription_paye
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
												comptes.id = '.intval($id_compte).'*/
							JOIN factures
								ON factures.inscription_id = inscriptions.id
					WHERE 
						inscriptions.date_fin IS NULL AND
						inscriptions.annee_id = (SELECT id FROM annees ORDER BY date_debut LIMIT 1,1);');
		return $retour[0][0]['nb_inscription_paye'];
	}
	
	function getInscriptionNonPayé($id_compte) {
		return $this->query('	SELECT
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
												comptes.id = '.intval($id_compte).'*/
							LEFT JOIN factures
								ON factures.inscription_id = Inscription.id
					WHERE 
						Inscription.date_fin IS NULL AND
						Inscription.annee_id = (SELECT id FROM annees ORDER BY date_debut LIMIT 1,1) AND
						factures.id IS NULL;');
	}
}

?>
