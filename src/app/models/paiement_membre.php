<?php
App::import('Sanitize');
class PaiementMembre extends AppModel {
	var $name = 'PaiementMembre';
	var $useTable = false;
	
	function getStatutPaiementMembre($recherche = NULL) {
		$conditions = "";
		if($recherche != NULL) {
			$recherche = Sanitize::escape($recherche);
			$recherche = str_replace(array("%", "_"), array("\%", "\_"), $recherche);
			$conditions = "WHERE 
						Adulte.nom LIKE '%$recherche%' OR 
						Adulte.prenom LIKE '%$recherche%' OR
						CONCAT(Adulte.prenom, ' ', Adulte.nom) LIKE '%$recherche%' OR 
						CONCAT(Adulte.nom, ' ', Adulte.prenom) LIKE '%$recherche%'";
		}
		
		
		return $this->query("	SELECT
						Adulte.id,
						Adulte.nom,
						Adulte.prenom,
						Adulte.courriel,
						Adulte.tel_maison,
						SUM(Adulte.montant_total) AS montant_total,
						SUM(Adulte.montant_paye) AS montant_paye,
						COUNT(Adulte.id) AS nb_inscription,
						COUNT(Adulte.montant_total) AS nb_facture
					FROM
						(SELECT
							adultes.id,
							adultes.nom,
							adultes.prenom,
							adultes.courriel,
							adultes.tel_maison,
					/*		(versements.montant) AS montant_total,*/
							(SELECT SUM(versements.montant) FROM versements WHERE versements.fraterie_id = factures.fraterie_id AND versements.nb_versement_id = factures.nb_versement_id) AS montant_total,
							SUM(paiements.montant) AS montant_paye
						FROM
							adultes
								JOIN adultes_enfants
									ON adultes.id = adultes_enfants.adulte_id
									JOIN enfants
										ON adultes_enfants.enfant_id = enfants.id
										JOIN inscriptions
											ON enfants.id = inscriptions.enfant_id
											LEFT JOIN factures
												ON inscriptions.id = factures.inscription_id 
												LEFT JOIN paiements
													ON factures.id = paiements.facture_id
					/*							LEFT JOIN versements
													ON 	factures.fraterie_id = versements.fraterie_id AND
														(SELECT 
															nb_versements.id
														FROM 
															nb_versements 
														WHERE 
															nb_versements.nb_versements = 1) = versements.nb_versement_id*/
						WHERE 
							inscriptions.date_fin IS NULL AND
							inscriptions.annee_id = (SELECT id FROM annees ORDER BY date_debut LIMIT 1,1)
						GROUP BY
							adultes.id,
							adultes.nom,
							adultes.prenom,
							adultes.courriel,
							adultes.tel_maison,
							factures.fraterie_id,
							factures.nb_versement_id) Adulte
					$conditions
					GROUP BY
						Adulte.id,
						Adulte.nom,
						Adulte.prenom,
						Adulte.courriel,
						Adulte.tel_maison;");
		
		/*$retour = array();
		for($i = 0; $i < count($status); ++$i) {
			$retour[] = array();
			$retourActuel = &$retour[count($retour) - 1];
			$retourActuel['id'] = $status[$i]['Adulte']['id'];
			$retourActuel['nom'] = $status[$i]['Adulte']['nom'];
			$retourActuel['prenom'] = $status[$i]['Adulte']['prenom'];
			$retourActuel['courriel'] = $status[$i]['Adulte']['courriel'];
			$retourActuel['tel_maison'] = $status[$i]['Adulte']['tel_maison'];
			$retourActuel['montant_total'] = 0;
			$retourActuel['montant_paye'] = 0;
			while($indexActuel == $status[$i]['Adulte']['id'] && $i < count($status)) {
				$retourActuel['montant_total'] += $status[$i][0]['montant_total'];
				$retourActuel['montant_paye'] += $status[$i][0]['montant_paye'];
				++$i;
			}
		}
		
		return $retour;*/
	}
}

?>
