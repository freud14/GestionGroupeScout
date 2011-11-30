<?php

/**
 * Cette classe sert de modèle pour la liste
 * de profil des enfants.
 * @author Frédérik Paradis
 */
class ListeProfilEnfant extends AppModel {

	/**
	 * Le nom du modèle
	 * @var string 
	 */
	var $name = 'ListeProfilEnfant';
	
	/**
	 * @var bool
	 */
	var $useTable = false;
	
	/**
	 * Cette méthode retourne la liste des enfants pour un parent.
	 * @param int $adulte_id L'ID du parent concerné
	 * @return array La liste des enfants d'un parent
	 */
	function getListeEnfant($adulte_id) {
		return $this->query('SELECT
								Inscription.id,
								Enfant.id,
								Enfant.nom,
								Enfant.prenom,
								IF(unites.nom IS NOT NULL, unites.nom, groupe_ages.nom) AS unite
							FROM
								inscriptions Inscription
									JOIN enfants Enfant
										ON Inscription.enfant_id = Enfant.id
										JOIN adultes_enfants
											ON 	adultes_enfants.enfant_id = Enfant.id AND
												adultes_enfants.adulte_id = '.intval($adulte_id).'
									JOIN annees
										ON Inscription.annee_id = annees.id
									LEFT JOIN unites
										ON Inscription.unite_id = unites.id
									JOIN groupe_ages
										ON Inscription.groupe_age_id = groupe_ages.id
							WHERE
								annees.date_fin IS NULL AND
								Inscription.date_fin IS NULL
							ORDER BY
								Enfant.nom,
								Enfant.prenom;');
	}

}

?>
