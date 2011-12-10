<?php
/**
 * Cette vue affiche la répartition des paiements.
 * @author Frédérik Paradis
 */
//On initialise une variable pour avoir les locales pour le signe de monnaie.
$locale = localeconv();

//On va chercher les informations à partir du contrôleur.
$repartition = $this->requestAction('repartition/index');
$montants_versement = $repartition['montants_versement'];
$frateries = $repartition['frateries'];
?>
<table class="tableau_generique">
	<thead>
		<tr>
			<th><?php echo wordwrap(__('Position de l\'enfant dans la famille', true), 20, '<br />'); ?></th>
			<?php
			$format = "%e %B %Y";
			// Vérifie sous Windows, pour trouver et remplacer le modificateur %e 
			// correctement
			if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
				$format = preg_replace('#(?<!%)((?:%%)*)%e#', '\1%#d', $format);
			}
            
			//On affiche les dates des versements
			foreach ($montants_versement as $versement) {
				//Si on est sur Windows, on encode notre date en UTF-8 sinon elle l'est déjà.
				if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
					echo "<th>" . utf8_encode(strftime($format, strtotime($versement['Versement']['date']))) . "</th>";
				} else {
					echo "<th>" . strftime($format, strtotime($versement['Versement']['date'])) . "</th>";
				}
			}
			?>
		</tr>
	</thead>
	<tbody>
		<?php
		//On mets les locales numériques à 'C' à cause d'un bug entre setlocale et NumberFormatter
		//setlocale(LC_NUMERIC, 'C');
		//$nf = new NumberFormatter(SET_LOCALE_ACTUEL, NumberFormatter::ORDINAL);
        
        
		$anciennePosition = 0;
		//On affiche chacun des positions suivit du montant total 
		// et du montant de chacun des versements pour chacun des dates.
		for ($i = 0; $i < count($frateries);) {
			$fraterie = $frateries[$i];
			echo '<tr>';
			while ($anciennePosition == $fraterie['Fraterie']['position'] && $i < count($frateries)) {
				if ($fraterie['Versement']['position'] == 0) {
					//On formatte le nombre d'enfant selon l'ordre ordinal.
					$prefixe = 'e';
					if ($fraterie['Fraterie']['position'] == 1) {
						$prefixe = 'er';
					}
					echo '<td>' . /* $nf->format( */$fraterie['Fraterie']['position']/* , NumberFormatter::TYPE_INT32) */ . '<sup>' . $prefixe . '</sup> ' . __('enfant', true) . ' (' . $fraterie['Versement']['montant'] . ' ' . $locale['currency_symbol'] . ')</td>';
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
        
		//setlocale(LC_ALL, SET_LOCALE_ACTUEL, SET_LOCALE_ACTUEL_WINDOWS);
		?>
	</tbody>
</table>
