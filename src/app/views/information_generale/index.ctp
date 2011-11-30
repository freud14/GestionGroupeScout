<?php
/**
 * Cette vue est la page pour la rentrée des informations générales de l'enfant.
 * @author Frédérik Paradis
 */
?>

<?php echo $form->create(null); ?>
<table>
	<tr>
		<td>
			<h3>Informations générales sur l'enfant</h3>

			<?php
			echo $form->input('nom', array('value' => $session['nom'],
				'label' => array('class' => 'element', 'text' => __('Nom', true) . ' <span class="star">*</span>')));
			?>

			<?php
			echo $form->input('prenom', array('value' => $session['prenom'], 'label' => array('class' => 'element', 'text' => __('Prénom', true) . ' <span class="star">*</span>')));
			?>

			<?php
			echo $form->input('sexe', array(
				'before' => $form->label('sexe', __('Sexe', true) . ' <span class="star">*</span>', array('class' => 'element')),
				'separator' => ' ',
				'options' => array('1' => __('Masculin', true), '2' => __('Féminin', true)),
				'type' => 'radio',
				'default' => $session['sexe'],
				'legend' => false
					)
			);
			?>
			
			<?php	
			echo $form->input('date_de_naissance', 
					array('empty' => true, 
						'selected' => array('day' => $session['date_de_naissance']['day'], 
							'month' => $session['date_de_naissance']['month'], 
							'year' => $session['date_de_naissance']['year']), 
						'separator' => '', 
						'type' => 'date', 
						'dateFormat' => 'DMY', 
						'minYear' => date('Y') - 100, 
						'maxYear' => date('Y') - 5, 
						'label' => array('text' => 'Date de naissance', 
							'class' => 'element')));
			?>

			<?php
			echo $form->input('assurance_maladie', array('value' => $session['assurance_maladie'], 'label' => array('class' => 'element', 'text' => __('Numéro d\'assurance maladie', true) . ' <span class="star">*</span>')));
			?>

			<?php
			echo $form->input('adresse', array('value' => $session['adresse'], 'label' => array('text' => __('Adresse', true) . ' <span class="star">*</span>', 'class' => 'element'), 'rows' => '3', 'cols' => '25'));
			?>

			<?php
			echo $form->input('ville', array('value' => $session['ville'], 'label' => array('class' => 'element', 'text' => __('Ville', true) . ' <span class="star">*</span>')));
			?>

			<?php
			echo $form->input('code_postal', array('value' => $session['code_postal'], 'label' => array('class' => 'element', 'text' => __('Code postal', true) . ' <span class="star">*</span>')));
			?>

			<h3>Informations scolaires</h3>

			<?php
			echo $form->input('etab_scolaire', array('value' => $session['etab_scolaire'], 'label' => array('class' => 'element', 'text' => __('Nom de l\'établissement scolaire', true) . ' <span class="star">*</span>')));
			?>

			<?php
			echo $form->input('niveau_scolaire', array(
				'options' => array('' => '',
				        'pre' => __('Préscolaire', true),
					'pri' => __('Primaire', true),
					'sec' => __('Secondaire', true)),
				'value' => $session['niveau_scolaire'],
				'label' => array('text' => __('Niveau scolaire', true) . ' <span class="star">*</span>', ' class' => 'element')));
			
			?>

			<?php
			echo $form->input('enseignant', array('value' => $session['enseignant'], 'label' => array('class' => 'element', 'text' => __('Enseignant responsable', true) . ' <span class="star">*</span>')));
			?>

			<br><h3><?php echo __('Groupe d\'âge') ?> </h3>

			<?php
			//On va chercher les différents groupes d'âge.
			$liste = array();
			$liste[''] = '';
			foreach ($groupe_age as $groupe) {
				$strGroupe = __('Mixte', true);
				if($groupe['GroupeAge']['sexe'] == '1') {
					$strGroupe = __('Masculin', true);
				} else if($groupe['GroupeAge']['sexe'] == '2') {
					$strGroupe = __('Féminin', true);
				}
				$liste[$groupe['GroupeAge']['id']] = $groupe['GroupeAge']['nom'] . " (" . $groupe['GroupeAge']['age_min'] . "-" . $groupe['GroupeAge']['age_max'] . " ans - " . $strGroupe . ")";
			}
			echo $form->input('groupe_age', array(
				'options' => $liste,
				'value' => $session['groupe_age'],
				'label' => false));
			?>
		</td>
		<td>

			<h3>Autre parent ou tuteur</h3>
			<?php
			echo $form->input('nom_tuteur', array('value' => $session['nom_tuteur'], 'label' => array('class' => 'element', 'text' => __('Nom', true))));
			?>

			<?php
			echo $form->input('prenom_tuteur', array('value' => $session['prenom_tuteur'], 'label' => array('class' => 'element', 'text' => __('Prénom', true))));
			?>
			
			<?php
			echo $form->input('sexe_tuteur', array(
				'before' => $form->label('sexe_tuteur', __('Sexe', true), array('class' => 'element')),
				'separator' => ' ',
				'options' => array('1' => __('Masculin', true), '2' => __('Féminin', true)),
				'type' => 'radio',
				'default' => $session['sexe_tuteur'],
				'legend' => false
					)
			);
			?>

			<?php
			echo $form->input('courriel_tuteur', array('value' => $session['courriel_tuteur'], 'label' => array('class' => 'element', 'text' => __('Courriel', true))));
			?>

			<?php
			echo $form->input('telephone_maison_tuteur', array('value' => $session['telephone_maison_tuteur'], 'label' => array('class' => 'element', 'text' => __('Téléphone à la maison', true))));
			?>

			<?php
			echo $form->input('telephone_bureau_tuteur', array('value' => $session['telephone_bureau_tuteur'], 'label' => array('class' => 'element', 'text' => __('Téléphone au bureau', true))));
			?>

			<?php
			echo $form->input('telephone_bureau_poste_tuteur', array('value' => $session['telephone_bureau_poste_tuteur'], 'label' => array('class' => 'element', 'text' => __('Numéro du poste', true))));
			?>


			<?php
			echo $form->input('cellulaire_tuteur', array('value' => $session['cellulaire_tuteur'], 'label' => array('class' => 'element', 'text' => __('Cellulaire', true))));
			?>

			<?php
			echo $form->input('emploi_tuteur', array('value' => $session['emploi_tuteur'], 'label' => array('class' => 'element', 'text' => __('Emploi', true))));
			?>

			<h3>Contact d'urgence</h3>
			<?php
			echo $form->input('nom_urgence', array('value' => $session['nom_urgence'], 'label' => array('class' => 'element', 'text' => __('Nom', true) . ' <span class="star">*</span>')));
			?>

			<?php
			echo $form->input('prenom_urgence', array('value' => $session['prenom_urgence'], 'label' => array('class' => 'element', 'text' => __('Prénom', true) . ' <span class="star">*</span>')));
			?>

			<?php
			echo $form->input('telephone_principal_urgence', array('value' => $session['telephone_principal_urgence'], 'label' => array('class' => 'element', 'text' => __('Téléphone principal', true) . ' <span class="star">*</span>')));
			?>

			<?php
			echo $form->input('lien_jeune_urgence', array('value' => $session['lien_jeune_urgence'], 'label' => array('class' => 'element', 'text' => __('Lien avec le jeune', true) . ' <span class="star">*</span>')));
			?>

			<h3>Particularité de votre jeune (« Bon à savoir »)</h3>

			<?php
			echo $form->textarea('particularite', array('value' => $session['particularite'], 'rows' => 5, 'cols' => 35));
			?>

		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div style="text-align:right;padding-top: 20px ">

				<?php
				echo $form->button(__('Annuler l\'inscription', true), array('type' => 'submit', 'name' => 'annuler'));
				echo "&nbsp;&nbsp;&nbsp;";
				echo $form->button(__('Étape suivante', true), array('type' => 'submit', 'name' => 'suivant'));
				echo $form->end();
				?>
			</div>
		</td>
	</tr>
</table>

