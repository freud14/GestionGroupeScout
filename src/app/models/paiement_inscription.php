<?php

/**
 * Cette classe sert de modèle pour le 
 * la gestion des paiements dans le système.
 * @author Frédérik Paradis
 */
class PaiementInscription extends AppModel {

	/**
	 * Le nom du modèle
	 * @var string 
	 */
	var $name = 'PaiementInscription';
	
	/**
	 * @var bool
	 */
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
						COUNT(inscriptions.id) as nb_inscription_paye #On compte le nombre d\'inscription.
					FROM
						inscriptions
							JOIN enfants
								ON inscriptions.enfant_id = enfants.id
								JOIN adultes_enfants
									ON enfants.id = adultes_enfants.enfant_id
									JOIN adultes
										ON	adultes_enfants.adulte_id = adultes.id AND
											adultes.id = ' . intval($adulte_id) . '
							JOIN factures #Dont \'inscription a une facture
								ON factures.inscription_id = inscriptions.id
                            JOIN annees
                                ON inscriptions.annee_id = annees.id
					WHERE 
						inscriptions.date_fin IS NULL AND #Pour les inscriptions non finis.
						annees.date_fin IS NULL #Pour l\'année actuelle
						;', false);
		return $retour[0][0]['nb_inscription_paye'];
	}

	/**
	 * Cette méthode retourne la liste des inscriptions
	 * non payé d'un membre.
	 * @param int $adulte_id
	 * @return array Retourne les données sous forme de tableau.
	 */
	function getInscriptionNonPayé($adulte_id) {
		return h($this->query('	SELECT
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
											adultes.id = ' . intval($adulte_id) . ' #Pour l\'adulte concerné
							LEFT JOIN factures
								ON factures.inscription_id = Inscription.id
                            JOIN annees
                                ON inscriptions.annee_id = annees.id
					WHERE 
						Inscription.date_fin IS NULL AND #Pour les inscriptions non terminées
						annees.date_fin IS NULL AND # Pour l\'année actuelle
						factures.id IS NULL #Pour avoir les factures qui n\'ont pas été générées.
						;', false), ENT_NOQUOTES);
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
											#On sélectionne les sous-paiements pour chacun des paiements principals
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
										nb_versements.nb_versements = 1 #On sélectionne seulement les paiements principals
									ORDER BY
										frateries.position,
										versements.position,
										tarifs.versement_position;");

		//Pour chacun des versements retournés, on groupe
		//les totaux avec leurs versements multiples.
		$retour = array();
		$fraterie_id_precedent = 0;
		$indexActuel = -1;
		foreach ($versements as $versement) {
			
			//On regarde si on est toujour dans la même fraterie.
			if ($indexActuel == -1 || $fraterie_id_precedent != $versement['frateries']['fraterie_id']) {
				//Si non, on agrandi notre tableau et on défini la structure de notre « sous-tableau »
				$retour[] = array('Fraterie' => array('id' => $versement['frateries']['fraterie_id'], 'position' => $versement['frateries']['position']),
					'Versement' => array('montant' => $versement['versements']['montant'], 'nb_versement_id' => $versement['nb_versements']['nb_versement_id'], 'fraterie_id' => $versement['frateries']['fraterie_id']),
					'NbVersement' => array('id' => $versement['nb_versements']['nb_versement_id']),
					'Tarifs' => array());
				$fraterie_id_precedent = $versement['frateries']['fraterie_id'];
				$indexActuel = count($retour) - 1;
			}
			
			//On place les différents versements dans l'index Tarifs de l'index
			//actuel du tableau.
			$retour[$indexActuel]['Tarifs'][] = array();
			$indexTarif = count($retour[$indexActuel]['Tarifs']) - 1;
			$retour[$indexActuel]['Tarifs'][$indexTarif]['montant'] = $versement['tarifs']['versement_montant'];
			$retour[$indexActuel]['Tarifs'][$indexTarif]['nb_versement_id'] = $versement['tarifs']['versement_nb_versement_id'];
			$retour[$indexActuel]['Tarifs'][$indexTarif]['fraterie_id'] = $versement['tarifs']['versement_fraterie_id'];
			
		}

		return h($retour, ENT_NOQUOTES);
	}

}

?>