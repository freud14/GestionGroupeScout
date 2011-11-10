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
				if($inscription[0]['type_paiement'] == '') {
					$inscription[0]['type_paiement'] = __('Indéterminé', true);
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
			<td><?php echo $inscription[0]['type_paiement']; ?></td>
			<td><?php echo $inscription[0]['montant_paye']; ?></td>
			<td><?php echo $inscription['versements']['montant_total']; ?></td>
			<td><?php echo $inscription[0]['statut']; ?></td>
			<td><?php echo $inscription[0]['derniere_date_paiement']; ?></td>
			<td><?php echo $inscription[0]['prochain_paiement']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php
	pr($inscriptions);
?>
<!--
<?php
	pr($frateries);
?>
	<?php
	$prix_totaux = array();
	$prix = array();
	foreach($frateries as $fraterie) {
		$prix[] = array();
		foreach($fraterie['Versement'] as $versement) {
			if($versement['position'] != 0) {
				$prix[count($prix) - 1] = $versement['montant'];
			}
			else {
				$prix_totaux[] = $versement['montant'];
			}
		}
	}
	pr($prix_totaux);
?>

<table class="tableau_generique">
	<thead>
		<tr>
			<th></th>
			<?php 
			$i = 0;
			foreach($frateries[0]['Versement'] as $versement) { ?>
				
				<?php if($versement['date'] != "") { ?>
				<?php echo "<th>".strftime("%e %B %Y", strtotime($versement['date']))." ".$prix_totaux[$i]."</th>"; ?>
				<?php ++$i ?>
				<?php } ?>
			<?php }	?>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
			</td>
		</tr>
	</tbody>
</table>-->
