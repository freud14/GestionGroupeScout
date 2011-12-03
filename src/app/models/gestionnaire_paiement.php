<?php

/**
 * Cette classe permet de récupérer les données
 * de paiements des membres.
 * @return Luc-Frédéric Langis
 * @return Frédérik Paradis
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
	 * Cette méthode retourne les informations nécessaire pour le reçu d'impot
	 * @param int $adulte_id L'id de l'adulte du membre.
	 * @return array Retourne les données sous forme de tableau.
	 */
	function getInscriptions($adulte_id) {
		return h($this->query('	SELECT
						inscriptions.id,
						CONCAT(enfants.prenom, " ", enfants.nom) AS enfant_nom,
						paiement_types.nom AS type_paiement,
						SUM(IF(date_paiements IS NOT NULL, paiements.montant, 0)) AS montant_paye, #On trouve le montant total payé
						SUM(paiements.montant) AS montant_total, #On trouve le total des paiements de l\'inscription
						COUNT(paiements.date_reception) AS nb_recu, #On trouve le nombre de paiement reçu
						COUNT(paiements.date_paiements) AS nb_paiement, #On trouve le nombre de paiement payé
						COUNT(paiements.id) AS nb_total_paiement, #On compte le nombre total de paiement
						MAX(paiements.date_paiements) AS dernier_paiement, #On trouve le dernier paiement payé
						#Si la somme des montants des paiements n\'équivaut pas à la somme des montants payés,
						#on trouve le prochain paiement.
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
											adultes.id = ' . intval($adulte_id) . ' #On sélectionne l\'adulte concerné.
							LEFT JOIN factures
								ON inscriptions.id = factures.inscription_id
								LEFT JOIN frateries
									ON factures.fraterie_id = frateries.id
								LEFT JOIN paiements
									ON factures.id = paiements.facture_id
									LEFT JOIN paiement_types
										ON paiements.paiement_type_id = paiement_types.id
					WHERE 
						inscriptions.date_fin IS NULL AND #L\'année n\'est pas fini
						inscriptions.annee_id = (SELECT id FROM annees ORDER BY date_debut LIMIT 1,1) #On sélectionne l\'année actuelle.
					GROUP BY
						enfants.id,
						enfants.prenom,
						enfants.nom,
						paiement_types.nom,
						paiement_types.id,
						inscriptions.date_fin,
						inscriptions.annee_id
					ORDER BY
						frateries.position;', false), ENT_NOQUOTES);
	}
}

?>
