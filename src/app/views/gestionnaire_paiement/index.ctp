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
		</tr>
	</thead>
	<tbody>
		<?php foreach($inscriptions as $inscription) { ?>
		<tr>
			<?php
				if($inscription['paiement_types']['type_paiement'] == '') {
					$inscription['paiement_types']['type_paiement'] = __('Indéterminé', true);
				}
			
				$inscription[0]['montant_paye'] .= ' '.$locale['currency_symbol'];
			
				if($inscription['versements']['montant_total'] == '') {
					$inscription['versements']['montant_total'] = __('Indéterminé', true);
				}
				else {
					$inscription['versements']['montant_total'] .= ' '.$locale['currency_symbol'];
				}
			
				if($inscription[0]['statut'] == 0) {
					$inscription[0]['statut'] = __('Impayé', true);
				}
				else {
					$inscription[0]['statut'] = __('Payé', true);
				}
			
				if($inscription[0]['derniere_date_paiement'] == '') {
					$inscription[0]['derniere_date_paiement'] = __('Non disponible', true);
				}
				else {
					$inscription[0]['derniere_date_paiement'] = strftime("%e %B %Y", strtotime($inscription[0]['derniere_date_paiement']));
				}
			
				if($inscription[0]['prochain_paiement'] == '') {
					$inscription[0]['prochain_paiement'] = __('Non disponible', true);
				}
				else {
					$inscription[0]['prochain_paiement'] = strftime("%e %B %Y", strtotime($inscription[0]['prochain_paiement']));
				}
			?>
			
			<td><?php echo $inscription[0]['enfant_nom']; ?></td>
			<td><?php echo $inscription['paiement_types']['type_paiement']; ?></td>
			<td><?php echo $inscription[0]['montant_paye']; ?></td>
			<td><?php echo $inscription['versements']['montant_total']; ?></td>
			<td><?php echo $inscription[0]['statut']; ?></td>
			<td><?php echo $inscription[0]['derniere_date_paiement']; ?></td>
			<td><?php echo $inscription[0]['prochain_paiement']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php echo $form->create(null, array('url' => array('action' => 'effectuer_paiement'))); ?>
<div style="text-align: right;"><?php echo $form->submit('Effectuer un paiement'); ?></div>
<?php $form->end(); ?>

<h3><?php __("Répartition des paiements"); ?></h3>
<?php echo $this->element('repartition'); ?>
