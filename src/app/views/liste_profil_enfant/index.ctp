<?php
/**
 * Cette vue affiche une liste d'enfant avec un lien
 * vers la visualisation et la modification des informations
 * générales et de la fiche médicale.
 * @author Frédérik Paradis
 */
?>

<table class="tableau_generique">
	<tr>
		<th><?php __('Nom de l\'enfant'); ?></th>
		<th><?php __('Unité'); ?></th>
		<th><?php echo wordwrap(__('Informations générales', true), 20, '<br />'); ?></th>
		<th><?php echo wordwrap(__('Fiche médicale', true), 20, '<br />'); ?></th>
	</tr>
	<?php foreach ($enfants as $enfant) { ?>
		<tr>
			<td style="width:200px; vertical-align: middle;"><?php echo $enfant['Enfant']['prenom'] . ' ' . $enfant['Enfant']['nom']; ?></td>
			<td style="width:150px; vertical-align: middle;"><?php echo $enfant[0]['unite']; ?></td>
			<td style="text-align:center; vertical-align: middle;"><?php echo nl2br($this->Html->link(wordwrap(__('Informations générales', true), 20), array('controller' => 'modifier_information_generale', 'action' => 'index', $enfant['Enfant']['id']))); ?></td>
			<td style="text-align:center; vertical-align: middle;"><?php echo nl2br($this->Html->link(wordwrap(__('Fiche médicale', true), 20), array('controller' => 'modifier_fiche_med', 'action' => 'index', $enfant['Enfant']['id']))); ?></td>
		</tr>
	<?php } ?>
</table>
