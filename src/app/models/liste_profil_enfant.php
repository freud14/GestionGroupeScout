<?php

class ListeProfilEnfant extends AppModel {

	var $name = 'ListeProfilEnfant';
	var $useTable = false;
	
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
