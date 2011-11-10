<div>
<h3><?php echo $form->label(__('Informations du compte', true)); ?> </h3>



<?php 
//	pr($option);
//	pr($enfant);
	echo '<table border="0">'.
		'<tr>'.
		'<td >';
			echo $form->input(__('Afficher',true), array('type' => 'select', 'options' => $option));
	echo '</td>'.
		'<td >';
			echo $this->Form->button(__('Exporter sur excel', true), array('type'=>'summit')); 
	echo'</td>'.
		'</tr>'.
		'</table>';



	?> 

<br><br>

	<div>
	
<?php 

	foreach($unite as $value){
		echo '<div>';
		echo '<h3>'. $value . '</h3>';
		echo '<table border="1">'.
		'<tr>'.
			'<td >'.
				'Nom' .
			'</td>'.
			'<td >'.
				'Sexe'.
			'</td>'.
			'<td >'.
				'Âge'.
			'</td>'.
		'</tr>';


		//	pr($enfant); 
			
			foreach ($enfant as $value){
					echo '<tr>'.
						 '<td>';
							echo $value['Enfant']['prenom'] . ' ' . $value['Enfant']['nom'];
					echo '</td>'.					
						  '<td>';
					
					
							//Puisque valeur numérique, on convertie
							if ($value['Enfant']['sexe'] == 1){
								echo 'M';
							} else {
								echo 'F';
							}
						
						
					echo '</td>'.
					      '<td>';
							echo $value['Enfant']['date_naissance'];
					echo '</td>'.
					     '</tr>';	
				}

				
		echo'</table>';		
		echo '</div>';
	}?>
	
	<div>

<br>

</div>
