<script>
	/*$(document).ready(function() {
		$("div.error").
	});*/

</script>

<?php
	echo $form->create(null, array('action' => 'fiche_medicale')); 
?>
<table>
<tr>
<td>
<h3>Informations générales sur l'enfant</h3>

<?php
	echo $form->input('nom', array('label' => array('class' => 'element', 'text' => __('Nom', true).' <span class="star">*</span>')));
?>

<?php
	echo $form->input('prenom', array('label' => array('class' => 'element', 'text' => __('Prénom', true).' <span class="star">*</span>')));
?>

<?php
	echo $form->label('sexe', __('Sexe', true).' <span class="star">*</span>', array('class' => 'element'));
	echo $form->radio('gender', 
			array('M' => __('Masculin', true),'F' => __('Féminin', true)), 
			array('label'=> false, 'legend' => false));
?>

<?php
	/*$elements = array();
	for($i = date('Y') - 70; $i = date('Y') - 5; ++$i) {
		$elements[] = $i;
	}
	
	
	echo $form->input('date_naissance', array('label' => 'Date de naissance',
							'dateFormat' => 'DMY',
							'minYear' => date('Y') - 70,
							'maxYear' => date('Y') - 5));*/
?>

<?php
	echo "<br/>";
	echo $form->label('date_de_naissance', __('Date de naissance', true).' <span class="star">*</span>', array('class' => 'element'));
	echo $form->day('jour_naissance');
	echo $form->month('mois_naissance');						
	echo $form->year('annee_naissance', date('Y') - 70, date('Y') - 5);
?>

<?php
	echo $form->input('assurance_maladie', array('label' => array('class' => 'element', 'text' => __('Numéro d\'assurance maladie', true).' <span class="star">*</span>')));
?>

<?php
	echo $form->label('adresse', __('Adresse', true).' <span class="star">*</span>', array('class' => 'element'));
	echo $form->textarea('adresse', array('rows' => 3, 'cols' => 25));
?>

<?php
	echo $form->input('ville', array('label' => array('class' => 'element', 'text' => __('Ville', true).' <span class="star">*</span>')));
?>

<?php
	echo $form->input('code_postal', array('label' => array('class' => 'element', 'text' => __('Code postal', true).' <span class="star">*</span>')));
?>

<h3>Informations scolaires</h3>

<?php
	echo $form->input('etab_scolaire', array('label' => array('class' => 'element', 'text' => __('Nom de l\'établissement scolaire', true).' <span class="star">*</span>')));
?>

<?php
	echo $form->label('niveau_scolaire', __('Niveau scolaire', true).' <span class="star">*</span>', array('class' => 'element'));
	echo $form->select('niveau_scolaire', array('pre' => __('Préscolaire', true),
							'pri' => __('Primaire', true), 
							'sec' => __('Secondaire', true)
							)
			);
?>

<?php
	echo $form->input('enseignant', array('label' => array('class' => 'element', 'text' => __('Enseignement responsable', true))));
?>

<h3>Unité</h3>
<?php 
	$liste = array();
	foreach($groupe_age as $groupe) {
		$liste[$groupe['GroupeAge']['id']] = $groupe['GroupeAge']['nom']. "(".$groupe['GroupeAge']['age_min']."-".$groupe['GroupeAge']['age_max']." ans - ".($groupe['GroupeAge']['sexe'] == 'M' ? __("Masculin", true) : __("Féminin", true)).")";
	}
	echo $form->select('groupe_age', $liste);
?>

</td>
<td>
<h3>Autre parent ou tuteur</h3>
<?php
	echo $form->input('nom_tuteur', array('label' => array('class' => 'element', 'text' => __('Nom', true))));
?>

<?php
	echo $form->input('prenom_tuteur', array('label' => array('class' => 'element', 'text' => __('Prénom', true))));
?>

<?php
	echo $form->label('sexe_tuteur', __('Sexe', true), array('class' => 'element'));
	echo $form->radio('sexe_tuteur', 
			array('M' => __('Masculin', true),'F' => __('Féminin', true)), 
			array('label'=> false, 'legend' => false));
?>

<?php
	echo $form->input('courriel_tuteur', array('label' => array('class' => 'element', 'text' => __('Courriel', true))));
?>

<?php
	echo $form->input('telephone_maison_tuteur', array('label' => array('class' => 'element', 'text' => __('Téléphone à la maison', true))));
?>

<?php
	echo $form->input('telephone_bureau_tuteur', array('label' => array('class' => 'element', 'text' => __('Téléphone au bureau', true))));
?>

<?php
	echo $form->input('telephone_bureau_poste_tuteur', array('label' => array('class' => 'element', 'text' => __('Numéro du poste', true))));
?>


<?php
	echo $form->input('cellulaire_tuteur', array('label' => array('class' => 'element', 'text' => __('Cellulaire', true))));
?>

<?php
	echo $form->input('emploi_tuteur', array('label' => array('class' => 'element', 'text' => __('Emploi', true))));
?>

<h3>Contact d'urgence</h3>
<?php
	echo $form->input('nom_urgence', array('label' => array('class' => 'element', 'text' => __('Nom', true).' <span class="star">*</span>')));
?>

<?php
	echo $form->input('prenom_urgence', array('label' => array('class' => 'element', 'text' => __('Prénom', true).' <span class="star">*</span>')));
?>

<?php
	echo $form->input('telephone_principal_urgence', array('label' => array('class' => 'element', 'text' => __('Téléphone principal', true).' <span class="star">*</span>')));
?>

<?php
	echo $form->input('lien_jeune_urgence', array('label' => array('class' => 'element', 'text' => __('Lien avec le jeune', true).' <span class="star">*</span>')));
?>

<h3>Particularité de votre jeune (« Bon à savoir »)</h3>

<?php
	echo $form->textarea('particularite', array('rows' => 5, 'cols' => 35));
?>

</td>
</tr>
</table>
<div style="text-align:right">
<?php
	echo $form->end(__('Étape suivante', true));
?>
</div>

