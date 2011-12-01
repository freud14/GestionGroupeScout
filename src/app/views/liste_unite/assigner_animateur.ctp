<?php
/*
 *  Génère les listes d'animateur pour l'assignation
 */

echo $form->create('AssignerAnimateur', array('url' => array('controller' => 'ListeUnite', 'action' => 'assigner_animateur')));
?>
<table>
	<?php
	foreach ($listeUnite as $id_unite => $valeur) {
	?>
	        <tr>
	                <th style="text-align: left;padding-left: 50px">
				<h3>
				<?php echo $valeur['nom']; ?>
			</h3>
		</th>
	</tr>
	<tr>
		<td>
			<?php
				echo $this->Form->input($id_unite, array('type' => 'select',
				    'multiple' => 'checkbox',
				    'options' => $listeAnimateur,
				    'label' => false,
				    'selected' => $valeur['adulte']));
			?>

			</td>
		</tr>
<?php
			}
?>
</table>
			<tr>
				<td style="text-align: right">
<?php
			echo $form->button(__('Assigner', true), array('type' => 'submit', 'name' => 'assigner'));
			echo $form->end();
?>
		</td>
	</tr>
<?php
			
?>
	<style type="text/css">

		.checkbox{
			padding-left:100px;
		}

