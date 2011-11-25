<?php

class PaiementInscription extends AppModel {

	var $name = 'PaiementInscription';
	var $useTable = false;

	/**
	 * Cette méthode retourne le nombre d'inscription
	 * qu'un membre s'est engagé à payer.
	 * @param int $adulte_id L'id de l'adulte du membre.
	 * @return int Retourne le nombre d'inscription qu'un
	 *  membre s'est engagé à payer.
	 */
	function getNbInscriptionPayé($adulte_id) {
		$retour = $this->query('SELECT
						COUNT(inscriptions.id) as nb_inscription_paye
					FROM
						inscriptions
							JOIN enfants
								ON inscriptions.enfant_id = enfants.id
								JOIN adultes_enfants
									ON enfants.id = adultes_enfants.enfant_id
									JOIN adultes
										ON	adultes_enfants.adulte_id = adultes.id AND
											adultes.id = ' . intval($adulte_id) . '
							JOIN factures
								ON factures.inscription_id = inscriptions.id
					WHERE 
						inscriptions.date_fin IS NULL AND
						inscriptions.annee_id = (SELECT id FROM annees ORDER BY date_debut LIMIT 1,1);', false);
		return $retour[0][0]['nb_inscription_paye'];
	}

	/**
	 * Cette méthode retourne la liste des inscriptions
	 * non payé d'un membre.
	 * @param int $adulte_id
	 * @return array Retourne les données sous forme de tableau.
	 */
	function getInscriptionNonPayé($adulte_id) {
		return $this->query('	SELECT
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
										ON	adultes_enfants.adulte_id = adultes.id AND
											adultes.id = ' . intval($adulte_id) . '
							LEFT JOIN factures
								ON factures.inscription_id = Inscription.id
					WHERE 
						Inscription.date_fin IS NULL AND
						Inscription.annee_id = (SELECT id FROM annees ORDER BY date_debut LIMIT 1,1) AND
						factures.id IS NULL;', false);
	}

	/**
	 * Cette méthode retourne un tableau dont la forme
	 * est utile pour récupérer les différents versements
	 * par rapport à la fraterie.
	 * @return array Retourne les données sous forme de tableau. 
	 */
	function getTarifs() {
		$versements = $this->query("SELECT
										frateries.position,
										versements.montant,
										nb_versements.id AS nb_versement_id,
										frateries.id AS fraterie_id,
										tarifs.versement_montant,
										tarifs.versement_date,
										tarifs.versement_fraterie_id,
										tarifs.versement_nb_versement_id
									FROM	
										versements
											JOIN frateries
												ON versements.fraterie_id = frateries.id
											JOIN nb_versements
												ON versements.nb_versement_id = nb_versements.id
											JOIN 	(SELECT
													frateries2.position 		AS fraterie_position,
													versements2.date 		AS versement_date,
													versements2.montant 		AS versement_montant,
													versements2.position 		AS versement_position,
													frateries2.id 			AS versement_fraterie_id,
													nb_versements2.id 		AS versement_nb_versement_id
												FROM	
													versements versements2
														JOIN frateries frateries2
															ON versements2.fraterie_id = frateries2.id
														JOIN nb_versements nb_versements2
															ON versements2.nb_versement_id = nb_versements2.id
												WHERE
													nb_versements2.nb_versements != 1) tarifs
														ON tarifs.fraterie_position = frateries.position
									WHERE
										nb_versements.nb_versements = 1
									ORDER BY
										frateries.position,
										versements.position,
										tarifs.versement_position;");

		$retour = array();
		$fraterie_id_precedent = 0;
		$indexActuel = -1;
		foreach ($versements as $versement) {
			if ($indexActuel == -1 || $fraterie_id_precedent != $versement['frateries']['fraterie_id']) {
				$retour[] = array('Fraterie' => array('id' => $versement['frateries']['fraterie_id'], 'position' => $versement['frateries']['position']),
					'Versement' => array('montant' => $versement['versements']['montant'], 'nb_versement_id' => $versement['nb_versements']['nb_versement_id'], 'fraterie_id' => $versement['frateries']['fraterie_id']),
					'NbVersement' => array('id' => $versement['nb_versements']['nb_versement_id']),
					'Tarifs' => array());
				$fraterie_id_precedent = $versement['frateries']['fraterie_id'];
				$indexActuel = count($retour) - 1;
			}
			$retour[$indexActuel]['Tarifs'][] = array();
			$indexTarif = count($retour[$indexActuel]['Tarifs']) - 1;
			$retour[$indexActuel]['Tarifs'][$indexTarif]['montant'] = $versement['tarifs']['versement_montant'];
			$retour[$indexActuel]['Tarifs'][$indexTarif]['nb_versement_id'] = $versement['tarifs']['versement_nb_versement_id'];
			$retour[$indexActuel]['Tarifs'][$indexTarif]['fraterie_id'] = $versement['tarifs']['versement_fraterie_id'];
		}

		return $retour;
	}

}

?>