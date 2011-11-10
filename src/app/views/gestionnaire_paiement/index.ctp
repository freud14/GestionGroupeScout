
<h3>Liste des enfants</h3>

<table class="tableau_generique">
	<thead>
		<tr>
			<th>Nom de l'enfant</th>
			<th>Mode de paiement</th>
			<th>Montant payé</th>
			<th>Coût total</th>
			<th>État</th>
			<th>Date du dernier paiement</th>
			<th>Date du prochain paiement</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($inscriptions as $inscription) { ?>
		<tr>
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
