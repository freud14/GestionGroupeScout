<?php
	echo '<table border="0">'.
		'<tr>'.
		'<td >';
		 echo $form->create('Voir', array('url' => array('controller' => 'ListeUnite', 'action' => 'Index')));
		 echo $this->Form->input(__('Afficher',true), array('type' => 'select', 'options' => $option));

	echo '</td>'.
		'<td >';
			echo $this->Form->button(__('Voir', true), array('type'=>'summit')); 
			echo $form->end();
	echo'</td>'.
		'</tr>'.
		'</table>';
?> 


<?php echo __('Jeune non assignés', true); ?>

<?php 
	foreach($unite as $value){
		echo '<div>';
		if($value['GroupeAge']['sexe'] == 1){

			$sexe = 'Masculin';
		} else {
			$sexe = 'Feminin';
		}
		echo '<h3>'. $value['Unite']['nom'] . ' | ' .  $value['GroupeAge']['age_min'] . '-' . $value['GroupeAge']['age_max'] . ' | Sexe : ' .  $sexe . '</h3>';
		echo '<table border="1">'.
		'<tr>'.
			'<td class="nom_enfant">'.
				'Nom' .
			'</td>'.
			'<td>'.
				'Sexe'.
			'</td>'.
			'<td>'.
				'Âge'.
			'</td>'.
		'</tr>';

		foreach($value['Inscription'] as $inscription){
			
				echo '<tr>' .
					 '<td>';
					 	echo $inscription['Enfant']['prenom'] . ' ' . $inscription['Enfant']['nom'];
				
				echo '</td>'.
				      '<td>';
						
						if($inscription['Enfant']['sexe'] == 1){
							echo 'M';
						}else{
							echo 'F';
						}

				echo '</td>'.
				     '<td>';

					echo $inscription['Enfant']['date_naissance'];
				
				echo '</td>'.
					 '</tr>';



		}

						
		echo'</table>';		
		echo '</div>';
	}?>
	
	<div>

<br>

</div>
