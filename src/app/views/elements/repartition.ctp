<?php
$locale = localeconv();
$tmp = $this->requestAction('repartition/index');
$montants_versement = $tmp['montants_versement'];
$frateries = $tmp['frateries'];
?>
<table class="tableau_generique">
	<thead>
		<tr>
			<th><?php echo wordwrap(__('Position de l\'enfant dans la famille', true), 20, '<br />'); ?></th>
			<?php
			//On affiche les dates des versements
			foreach ($montants_versement as $versement) {
				echo "<th>" . strftime("%e %B %Y", strtotime($versement['Versement']['date'])) . "</th>";
			}
			?>
		</tr>
	</thead>
	<tbody>
		<?php
		setlocale(LC_NUMERIC, 'C');
		$nf = new NumberFormatter(SET_LOCALE_ACTUEL, NumberFormatter::ORDINAL);
		$anciennePosition = 0;
		//On affiche chacun des positions suivit du montant total 
		// et du montant de chacun des versements pour chacun des dates.
		for ($i = 0; $i < count($frateries);) {
			$fraterie = $frateries[$i];
			echo '<tr>';
			while ($anciennePosition == $fraterie['Fraterie']['position'] && $i < count($frateries)) {
				if ($fraterie['Versement']['position'] == 0) {
					echo '<td>' . $nf->format($fraterie['Fraterie']['position'], NumberFormatter::TYPE_INT32) . ' ' . __('enfant', true) . ' (' . $fraterie['Versement']['montant'] . ' ' . $locale['currency_symbol'] . ')</td>';
				} else {
					echo '<td>' . $fraterie['Versement']['montant'] . ' ' . $locale['currency_symbol'] . '</td>';
				}
				++$i;
				if ($i >= count($frateries)) {
					break(2);
				}
				$fraterie = $frateries[$i];
			}
			$anciennePosition = $fraterie['Fraterie']['position'];
			echo '</tr>';
		}
		setlocale(LC_ALL, SET_LOCALE_ACTUEL);
		?>
	</tbody>
</table>
