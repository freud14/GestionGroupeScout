<?php
$locale = localeconv();
?>
<p><em>Note: Sauf pour des raisons exceptionnelles, aucun remboursement des frais d'inscription ne sera effectué lorsqu'un jeune quitte en cours d'année.</em></p>
<h3>Mode de paiement</h3>
<p><em>Note: Les animateurs et animatrices du 102<sup>e</sup> Groupe scout de Laurentides qui inscrivent leur enfant bénéficient d'un rabais de 20$ par famille.</em>
<h4>Via paiement en ligne</h4>
<p>Vous pouvez payer l'inscription via notre service de paiement en ligne PayPal.</p>
<h4>Via chèque</h4>
<p>Vous pouvez faire votre chèque à l'ordre du 102<sup>e</sup> Groupe scout de Laurentides. Vous pouvez remettre le chèque en main propre ou l'envoyer à l'adresse suivante:</p>
<quote>
	102<sup>e</sup> Groupe scout de Laurentides
	<br />455 des Couventines
	<br />Lac St-Charles, Québec
	<br />G3G 1J9
</quote>
<p>Soit:
<ul>
	<li>Un chèque couvrant la totalité du coût de l'inscription</li>
	<li>Plusieurs versements répartis de la façon suivante:
		<?php echo $this->element('repartition'); ?>
	</li>
</ul>
</p>
<p><em>Important: 
		<br /> - Indiquer le nom de l'enfant et son unité en bas à gauche</em>
</p>
<h3>Liste des enfants</h3>
<script>
	var versements = [<?php
		$count = count($versements);
		$i = 0;
		foreach ($versements as $versement) {
			echo $versement['Versement']['montant'];
			if ($i < $count - 1) {
				echo ', ';
			}
			++$i;
		}
		?>];

					var nbEnfant = <?php echo $nb_inscription_paye; ?>;

					$(document).ready(function() {
						$(".inscription").click(function() {
							if($(this).is(':checked')) {
								if(nbEnfant < versements.length) {
									$("#total").text(parseInt($("#total").text()) + versements[nbEnfant]);
								}
								else {
									$("#total").text(parseInt($("#total").text()) + versements[versements.length  - 1]);
								}
								++nbEnfant;
							}
							else {
								--nbEnfant;
								if(nbEnfant < versements.length) {
									$("#total").text(parseInt($("#total").text()) - versements[nbEnfant]);
								}
								else {
									$("#total").text(parseInt($("#total").text()) - versements[versements.length - 1]);
								}
			
							}
		
						});
					});
</script>
<table class="tableau_generique">
	<tr>
		<th><?php __('Nom de l\'enfant'); ?></th>
		<th><?php __('Je veux payer pour cet enfant'); ?></th>
	</tr>
	<?php
	echo $this->Form->create(null);
	//$tab = array();
	foreach ($inscriptions as $inscription) {
		echo '<tr>';
		echo '<td>' . $inscription['Enfant']['prenom'] . ' ' . $inscription['Enfant']['nom'] . '</td>';
		echo '<td style="text-align:center;">' . $this->Form->checkbox('inscription' . $inscription['Inscription']['id'], array('value' => $inscription['Inscription']['id'], 'class' => 'inscription')) . '</td>';
		echo '</tr>';
		//$tab[$inscription['Inscription']['id']] = ''; //$inscription['Enfant']['prenom'].' '.$inscription['Enfant']['nom'];
	}
	//echo $this->Form->input('inscriptions', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $tab,'label' => false));
	?>
</table>
<p>
	<?php __('Montant total:'); ?> <span id="total">0</span> <?php echo $locale['currency_symbol']; ?>
</p>
<div style="float:left;">
	<?php
	echo $form->radio('mode', array(2 => __('Je vais payer l\'inscription complète en ligne', true)), array('legend' => false, 'value' => false));
	?>
	<br />
	<?php
	echo $form->radio('mode', array(5 => __('Je vais payer l\'inscription par paiements différés en ligne', true)), array('legend' => false, 'value' => false));
	?>
	<br />
	<?php
	echo $form->radio('mode', array(1 => __('Je vais payer l\'inscription complète en argent comptant et en main propre', true)), array('legend' => false, 'value' => false));
	?>
</div>
<div style="float:right;">
	<?php
	echo $form->radio('mode', array(4 => __('Je vais payer l\'inscription via chèques postdatés', true)), array('legend' => false, 'value' => false));
	?>
	<br />
	<?php
	echo $form->radio('mode', array(3 => __('Je vais payer l\'inscription via chèque', true)), array('legend' => false, 'value' => false));
	?>
</div>
<div style="clear:both;">
	<br />
	<?php
	echo $this->Form->end(__('Effectuer le paiement', true));
	?>
</div>
