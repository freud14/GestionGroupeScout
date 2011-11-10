<div>
<h3><?php echo $form->label(__('Informations du compte', true)); ?> </h3>



<?php echo $form->input(__('Afficher',true), array('type' => 'select', 'options' => array('tous', 'louveteaux')))?> 

<br><br>

	<div>
	

	<table border="1">
		<tr>
			<td >
				Nom
			</td>
			<td >
				Sexe
			</td>
			<td >
				Âge
			</td>

		</tr>

		<?php
			pr($enfant); 
			
			foreach ($enfant as $value){
					echo '<tr>';
						echo '<td>';
							echo $value['Enfant']['prenom'] . ' ' . $value['Enfant']['nom'];
						echo '</td>';
					
						echo '<td>';
					
					
							//Puisque valeur numérique, on convertie
							if ($value['Enfant']['sexe'] == 1){
								echo 'M';
							} else {
								echo 'F';
							}
						
						
						echo '</td>';

						echo '<td>';
							echo $value['Enfant']['date_naissance'];
						echo '</td>';
					echo '</tr>';	
				}

				
			

		?>
	</table>
	<div>

<br>
<p  align="right">
	<?php echo $this->Form->button(__('Exporter sur excel', true), array('type'=>'summit')); ?>
</p>

</div>
