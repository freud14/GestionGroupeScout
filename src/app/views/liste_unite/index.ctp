<?php
$accesNum = 0;
$autorisation = $this->Session->read('authentification.autorisation');
if (!empty($autorisation)) {
	foreach ($autorisation as $valeur) {
		if ($valeur['id'] > $accesNum) {
			$accesNum = $valeur['id'];
		}
	}
}
?>
<div>
	<h3><?php echo $form->label(__('Liste des unités', true)); ?> </h3>



	<?php
//	pr($option);
//	pr($enfant);
	echo '<table border="0">' .
	'<tr>' .
	'<td >';
	echo $form->create('ListeUnite', array('url' => array('controller' => 'ListeUnite', 'action' => 'Index')));


	echo $this->Form->input(__('Afficher', true), array('type' => 'select', 'options' => $option));

	echo '</td>' .
	'<td >';
	echo $this->Form->button(__('Appliquer', true), array('type' => 'summit'));
	echo $form->end();
	echo '</td>' .
	'<td >';
	if($accesNum >= 4) {
		echo $form->create('', array('url' => array('controller' => 'rapport_jeune', 'action' => 'liste.csv')));
		echo $this->Form->button(__('Exporter sur excel...', true), array('type' => 'summit'));
		echo $form->end();
	}
	echo'</td>' .
	'</tr>' .
	'</table>';
	?>

	<br><br>
	<div>

<?php
	foreach ($unite as $value) {
		echo '<div>';
		if ($value['GroupeAge']['sexe'] == 1) {

			$sexe = 'Masculin';
		} else {
			$sexe = 'Feminin';
		}
		echo '<h3>' . $value['Unite']['nom'] . ' | ' . $value['GroupeAge']['age_min'] . '-' . $value['GroupeAge']['age_max'] . ' | Sexe : ' . $sexe . '</h3>';
		echo '<table border="1">' .
		'<tr>' .
		'<td class="nom_enfant">' .
		'Nom' .
		'</td>' .
		'<td>' .
		'Sexe' .
		'</td>' .
		'<td>' .
		'Âge' .
		'</td>' .
		'</tr>';

		foreach ($value['Inscription'] as $inscription) {

			echo '<tr>' .
			'<td>';
			echo $inscription['Enfant']['prenom'] . ' ' . $inscription['Enfant']['nom'];

			echo '</td>' .
			'<td>';

			if ($inscription['Enfant']['sexe'] == 1) {
				echo 'M';
			} else {
				echo 'F';
			}

			echo '</td>' .
			'<td>';

			echo $inscription['Enfant']['date_naissance'];

			echo '</td>' .
			'</tr>';
		}


		echo'</table>';
		echo '</div>';
	} ?>

		<div>

			<br>

		</div>
