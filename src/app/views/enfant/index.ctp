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

		<tr>
		<?php
			pr($enfant); 
			
			foreach ($enfant as $value){
						echo '<td>';
						echo $enfant['Enfant']['nom'];
						echo '</td>';
					
						echo '<td>';
						echo $enfant['Enfant']['sexe'];
						echo '</td>';

						echo '<td>';
						echo $enfant['Enfant']['date_naissance'];
						echo '</td>';
				}

				
			

		?>
	</tr>
	</table>
	<div>

<br>
<p  align="right">
	<?php echo $this->Form->button(__('Exporter sur excel', true), array('type'=>'summit')); ?>
</p>

</div>
