<?php

/**
 * Le séparateur de fichier
 */
define('SEPARATEUR', ',');

/**
 * Mets des guillemets double autour de la chaine passée
 * en paramètre et ajoute le séparateur à la fin de la chaine.
 * @param string $colonne La chaine à formater
 * @return string Retourne la chaine formatée.
 */
function formaterColonneCSV($colonne) {
	return '"' . str_replace('"', '""', $colonne) . '"' . SEPARATEUR;
}

//pr($inscriptions);
$affiche = "";

//En-tête du CSV
//Information sur l'enfant
$affiche .= formaterColonneCSV(__('Unité', true));
$affiche .= formaterColonneCSV(__('Groupe d\'âge', true));
$affiche .= formaterColonneCSV(__('Prénom de l\'enfant', true));
$affiche .= formaterColonneCSV(__('Nom de l\'enfant', true));
$affiche .= formaterColonneCSV(__('Date de naissance', true));
$affiche .= formaterColonneCSV(__('Adresse', true));
$affiche .= formaterColonneCSV(__('Ville', true));
$affiche .= formaterColonneCSV(__('Code postal', true));

//Contact d'urgence
$affiche .= formaterColonneCSV(__('Prénom du contact d\'urgence', true));
$affiche .= formaterColonneCSV(__('Nom du contact d\'urgence', true));
$affiche .= formaterColonneCSV(__('Numéro de téléphone', true));
$affiche .= formaterColonneCSV(__('Lien avec l\'enfant', true));

//Parent(s)
$affiche .= formaterColonneCSV(__('Prénom du parent', true));
$affiche .= formaterColonneCSV(__('Nom du parent', true));
$affiche .= formaterColonneCSV(__('Numéro de téléphone', true));
$affiche .= formaterColonneCSV(__('Sexe', true));
$affiche .= formaterColonneCSV(__('Profession', true));
$affiche .= formaterColonneCSV(__('Courriel', true));

$affiche .= formaterColonneCSV(__('Prénom du parent', true));
$affiche .= formaterColonneCSV(__('Nom du parent', true));
$affiche .= formaterColonneCSV(__('Numéro de téléphone', true));
$affiche .= formaterColonneCSV(__('Sexe', true));
$affiche .= formaterColonneCSV(__('Profession', true));
$affiche .= formaterColonneCSV(__('Courriel', true));

$affiche = trim($affiche, ",");
$affiche .= "\r\n";

foreach ($inscriptions as $inscription) {

	//Information sur l'enfant
	$affiche .= formaterColonneCSV($inscription['Unite']['nom'] != '' ? $inscription['Unite']['nom'] : __('Indéterminé', true));
	$groupe_age = $inscription['GroupeAge']['age_min'] . '-' . $inscription['GroupeAge']['age_max'] . ' ' . __('ans', true) . ' - ';
	if ($inscription['GroupeAge']['sexe'] == 1) {
		$groupe_age .= __('Garçon', true);
	} else if ($inscription['GroupeAge']['sexe'] == 2) {
		$groupe_age .= __('Fille', true);
	} else {
		$groupe_age .= __('Mixte', true);
	}
	$affiche .= formaterColonneCSV($groupe_age);
	$affiche .= formaterColonneCSV($inscription['Enfant']['prenom']);
	$affiche .= formaterColonneCSV($inscription['Enfant']['nom']);
	$affiche .= formaterColonneCSV($inscription['Enfant']['date_naissance']);
	$affiche .= formaterColonneCSV($inscription['Enfant']['Adresse']['adresses']);
	$affiche .= formaterColonneCSV($inscription['Enfant']['Adresse']['ville']);
	$affiche .= formaterColonneCSV($inscription['Enfant']['Adresse']['code_postal']);

	//Contact d'urgence
	if (!empty($inscription['Enfant']['ContactUrgence'])) {
		$affiche .= formaterColonneCSV($inscription['Enfant']['ContactUrgence'][0]['Adulte']['prenom']);
		$affiche .= formaterColonneCSV($inscription['Enfant']['ContactUrgence'][0]['Adulte']['nom']);
		$affiche .= formaterColonneCSV($inscription['Enfant']['ContactUrgence'][0]['Adulte']['tel_maison']);
		$affiche .= formaterColonneCSV($inscription['Enfant']['ContactUrgence'][0]['lien']);
	} else {
		$affiche .= formaterColonneCSV(__('Indéterminé', true));
		$affiche .= formaterColonneCSV(__('Indéterminé', true));
		$affiche .= formaterColonneCSV(__('Indéterminé', true));
		$affiche .= formaterColonneCSV(__('Indéterminé', true));
	}
	//Information sur ses parents
	foreach ($inscription['Enfant']['Adulte'] as $adulte) {
		$affiche .= formaterColonneCSV($adulte['prenom']);
		$affiche .= formaterColonneCSV($adulte['nom']);
		$affiche .= formaterColonneCSV($adulte['tel_maison']);
		$affiche .= formaterColonneCSV($adulte['sexe'] == 1 ? 'M' : 'F');
		$affiche .= formaterColonneCSV($adulte['profession']);
		$affiche .= formaterColonneCSV($adulte['courriel'] == '' ? 'Aucun' : $adulte['courriel']);
	}


	$affiche = trim($affiche, ",");
	$affiche .= "\r\n";
}

echo trim($affiche);
?>