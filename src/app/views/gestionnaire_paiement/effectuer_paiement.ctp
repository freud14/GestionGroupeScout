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
		//On affiche chacun des versements dans le tableau javascript
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

				var nbEnfant = <?php echo $nb_inscription_paye; //On assigne la variable JS au nombre d'inscription déjà payé.  ?>;

				$(document).ready(function() {
					var inscriptions = $(".inscription");
					for(var i = 0; i < inscriptions.length; ++i) {
						if($(inscriptions[i]).is(':checked')) {
							if(nbEnfant < versements.length) {
								$("#total").text(parseInt($("#total").text()) + versements[nbEnfant]);
							}
							else {
								$("#total").text(parseInt($("#total").text()) + versements[versements.length  - 1]);
							}
							++nbEnfant;
						}
					}
						
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
	foreach ($inscriptions as $inscription) {
		echo '<tr>';
		echo '<td>' . $inscription['Enfant']['prenom'] . ' ' . $inscription['Enfant']['nom'] . '</td>';
		echo '<td style="text-align:center;">' . $this->Form->checkbox('inscription' . $inscription['Inscription']['id'], array('value' => $inscription['Inscription']['id'], 'class' => 'inscription')) . '</td>';
		echo '</tr>';
	}
	?>
</table>
<p>
	<?php __('Montant total:'); ?> <span id="total">0</span> <?php echo $locale['currency_symbol']; ?>
</p>
<p style="color: red;">
<?php
if (isset($aucun_mode_choisi)) {
	__('Vous n\'avez chosi aucun mode de paiement. Veuillez choisir un mode de paiement.');
}
?>
</p>
<div style="float:left;">
	<?php
	/*
	 * Les IDs des différents types de paiement sont relatifs 
	 * à la base de données. Ils sont donc statiques dans la 
	 * base de données et ne doivent pas être changés.
	 */
	?>
	<?php
	echo $form->radio('mode', array(2 => __('Je vais payer l\'inscription complète en ligne avec Paypal', true)), array('legend' => false, 'value' => false));
	?>
	<br />
	<?php
	echo nl2br($form->radio('mode', array(5 => wordwrap(__('Je vais payer l\'inscription par paiements différés en ligne avec Paypal (Non disponible pour l\'instant)', true), 75)), array('legend' => false, 'value' => false, 'disabled' => 'disabled')));
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
<div style="clear:both; text-align: right">
	<br />
	<?php
	echo $form->button(__('Retourner au gestionnaire des paiements', true), array('type' => 'submit', 'name' => 'annuler'));
	echo $form->button(__('Effectuer le paiement', true), array('type' => 'submit', 'name' => 'payer'));
	echo $this->Form->end(null);
	?>
</div>
