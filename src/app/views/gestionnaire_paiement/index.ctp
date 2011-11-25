<?php
$locale = localeconv();
?>
<h3><?php __("Liste des enfants"); ?></h3>

<table class="tableau_generique">
	<thead>
		<tr>
			<th><?php __("Nom de l'enfant"); ?></th>
			<th><?php __("Mode de paiement"); ?></th>
			<th><?php __("Montant payé"); ?></th>
			<th><?php __("Coût total"); ?></th>
			<th><?php __("État"); ?></th>
			<th><?php __("Date du dernier paiement"); ?></th>
			<th><?php __("Date du prochain paiement"); ?></th>
			<?php if (isset($admin)) { //Si la personne est un admin et qu'elle veut voir les enfants d'un parent.. ?>
				<th><?php __("Modifier"); ?></th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($inscriptions as $inscription) { ?>
			<tr>
				<?php
				//Si le type de paiement vaut NULL, on affiche « Non disponible »
				if ($inscription['paiement_types']['type_paiement'] == '') {
					$inscription['paiement_types']['type_paiement'] = __('Indéterminé', true);
				}

				$inscription[0]['montant_paye'] .= ' ' . $locale['currency_symbol'];

				//Si le montant total vaut NULL, on affiche « Non disponible »
				if ($inscription[0]['montant_total'] == '') {
					$inscription[0]['montant_total'] = __('Indéterminé', true);
				} else {
					$inscription[0]['montant_total'] .= ' ' . $locale['currency_symbol'];
				}

				//On choisit le statut du paiement selon les données reçu.
				if ($inscription[0]['nb_total_paiement'] == 0) {
					$inscription[0]['statut'] = __('Impayé', true);
				} else if ($inscription[0]['nb_recu'] == 0 || $inscription[0]['nb_recu'] != $inscription[0]['nb_total_paiement']) {
					$inscription[0]['statut'] = __('Non reçu', true);
				} else if ($inscription[0]['nb_paiement'] == $inscription[0]['nb_total_paiement']) {
					$inscription[0]['statut'] = __('Payé', true);
				} else { // if($inscription[0]['nb_recu'] == $inscription[0]['nb_total_paiement']) {
					$inscription[0]['statut'] = __('Reçu', true);
				}

				//Si la date du dernier paiement vaut NULL, on affiche « Non disponible »
				if ($inscription[0]['dernier_paiement'] == '') {
					$inscription[0]['dernier_paiement'] = __('Non disponible', true);
				} else {
					$inscription[0]['dernier_paiement'] = strftime("%e %B %Y", strtotime($inscription[0]['dernier_paiement']));
				}

				//Si la date du prochain paiement vaut NULL, on affiche « Non disponible »
				if ($inscription[0]['prochain_paiement'] == '') {
					$inscription[0]['prochain_paiement'] = __('Non disponible', true);
				} else {
					$inscription[0]['prochain_paiement'] = strftime("%e %B %Y", strtotime($inscription[0]['prochain_paiement']));
				}
				?>

				<td><?php echo $inscription[0]['enfant_nom']; ?></td>
				<td><?php echo $inscription['paiement_types']['type_paiement']; ?></td>
				<td><?php echo $inscription[0]['montant_paye']; ?></td>
				<td><?php echo $inscription[0]['montant_total']; ?></td>
				<td><?php echo $inscription[0]['statut']; ?></td>
				<td><?php echo $inscription[0]['dernier_paiement']; ?></td>
				<td><?php echo $inscription[0]['prochain_paiement']; ?></td>
				<?php if (isset($admin)) { ?>
					<td><?php echo $this->Html->link('Modifier', array('controller' => 'paiement_membre', 'action' => 'payer', $inscription['inscriptions']['id'], $id_adulte)); ?></td>
				<?php } ?>
			</tr>
		<?php } ?>
	</tbody>
</table>
<?php if (!isset($admin)) { //Si la personne est un admin et qu'elle veut voir les enfants d'un parent.., ?>
	<?php echo $form->create(null, array('url' => array('action' => 'effectuer_paiement'))); ?>
	<div style="text-align: right;"><?php echo $form->submit(__('Effectuer un paiement', true)); ?></div>
	<?php $form->end(); ?>
<?php } else { ?>
	<?php echo $form->create(null, array('url' => array('controller' => 'paiement_membre', 'action' => 'index'))); ?>
	<div style="text-align: right;"><?php echo $form->submit(__('Retour à la gestion des paiements', true)); ?></div>
	<?php $form->end(); ?>
<?php } ?>


<?php if (!isset($admin)) { //Si la personne est un admin et qu'elle veut voir les enfants d'un parent.. ?>
	<h3><?php __("Répartition des paiements"); ?></h3>
	<?php echo $this->element('repartition'); //On affiche notre « element » qui est notre répartition des paiements. ?>
<?php } ?>