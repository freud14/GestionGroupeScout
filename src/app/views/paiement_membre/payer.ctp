<?php
$locale = localeconv();
function cochéOuPasCoché($type_paiement, $mode_paiement_id) {
	if ($type_paiement == $mode_paiement_id) {
		return 'checked';
	} else {
		return '';
	}
}

function getSélectionParDéfaut($type_paiement, $mode_paiement_id, $versement) {
	if ($type_paiement == $mode_paiement_id) {
		if ($versement['date_paiements'] != '') {
			return 'paye';
		}
		if ($versement['date_reception'] != '') {
			return 'recu';
		}
	}

	return 'non_recu';
}
?>
<script>
	/*function ex() {
		var modes = $(".mode_paiement input");
		for (var i = 0; i < modes.length; ++i) {
			if($(modes[i]).is(':checked')) {
				$(modes[i]).css('display', 'block');
			}
			else {
				$(modes[i]).css('display', 'none');
			}
		}
	}
	$(".mode_paiement input").click(function() {
		ex();
	});
	ex();*/
	
	/*$(document).ready(function(){ 
		$(".mode_paiement input").change(function() {
			var test = $(this).val();
			$(".desc").hide();
			$("#"+test).show();
		}); 
	});*/

</script>
<h3><?php __('Récapitulatif'); ?></h3>
<div>
	<?php
	echo $form->label('nom', __('Nom de l\'enfant', true), array('class' => 'element'));
	echo '<strong>' . $inscription['Enfant']['prenom'] . ' ' . $inscription['Enfant']['nom'] . '</strong>';
	?>
</div>
<div>
	<?php
	echo $form->label('montant', __('Montant du paiement', true), array('class' => 'element'));
	echo '<strong>' . $montant . ' ' . $locale['currency_symbol'] . '</strong>';
	?>
</div>
<h3><?php __("Tableau des coûts d'inscription selon le nombre d'enfant."); ?></h3>
<?php echo $this->element('repartition'); //On affiche notre « element » qui est notre répartition des paiements.  ?>
<h3>Paiement</h3>
<p>Veuillez chosir le mode paiement associé à cet enfant.</p>
<style>
	.etat {
		padding-left: 15px;
	}
</style>
<?php

$etat = array('non_recu' => __('Non reçu', true),
	'recu' => __('Reçu', true),
	'paye' => __('Payé', true));

/*
 * Les IDs des différents types de paiement sont relatifs 
 * à la base de données. Ils sont donc statiques dans la 
 * base de données et ne doivent pas être changés.
 */
?>
<?php
echo $this->Form->create(null, array('url' => array('controller' => 'paiement_membre', 'action' => 'payer', $inscription_id, $adulte_id)));
?>
<div class="mode_paiement">
	<?php
	echo $form->radio('mode', array(ARGENT => __('Argent comptant', true)), array('legend' => false, 'value' => false, 'checked' => cochéOuPasCoché($type_paiement, ARGENT)));
	?>
</div>
<div class="etat">
	<?php
	echo $form->select('argent', array('non_recu' => $etat['non_recu'], 'paye' => $etat['paye']), getSélectionParDéfaut($type_paiement, ARGENT, $paiements[0]['Paiement']), array('empty' => false));
	?>
</div>
<div class="mode_paiement">
	<?php
	echo $form->radio('mode', array(CHEQUE => __('Chèque', true)), array('legend' => false, 'value' => false, 'checked' => cochéOuPasCoché($type_paiement, CHEQUE)));
	?>
</div>
<div class="etat">
	<?php
	echo $form->select('cheque', $etat, getSélectionParDéfaut($type_paiement, CHEQUE, $paiements[0]['Paiement']), array('empty' => false));
	?>
</div>
<div class="mode_paiement">
	<?php
	echo $form->radio('mode', array(CHEQUES_POSTDATES => __('Chèques postdatés', true)), array('legend' => false, 'value' => false, 'checked' => cochéOuPasCoché($type_paiement, CHEQUES_POSTDATES)));
	?>
</div>
<div class="etat">
	<table class="tableau_generique">
		<tr>
			<th></th>
			<?php
			foreach ($versements as $versement) {
				echo "<th>" . strftime("%e %B %Y", strtotime($versement['Versement']['date'])) . "</th>";
			}
			?>
		</tr>
		<tr>
			<td><strong>Statut</strong></td>
			<?php
			if ($type_paiement == CHEQUES_POSTDATES) {
				for ($i = 1; $i <= count($versements); ++$i) {
					echo "<td>" . $form->select('cheque' . $i, $etat, getSélectionParDéfaut($type_paiement, CHEQUES_POSTDATES, $paiements[$i - 1]['Paiement']), array('empty' => false)) . "</td>";
				}
			}
			else {
				for ($i = 1; $i <= count($versements); ++$i) {
					echo "<td>" . $form->select('cheque' . $i, $etat, 'non_recu', array('empty' => false)) . "</td>";
				}
			}
			?>
		</tr>
	</table>
</div>
<div class="mode_paiement">
	<?php
	echo $form->radio('mode', array(PAYPAL => __('Inscription complète en ligne (Non disponible pour l\'instant)', true)), array('legend' => false, 'value' => false, 'checked' => cochéOuPasCoché($type_paiement, PAYPAL), 'disabled' => 'disabled'));
	?>
</div>
<div class="mode_paiement">
	<?php
	echo $form->radio('mode', array(PAYPAL_DIFFERE => __('Paiements différés en ligne (Non disponible pour l\'instant)', true)), array('legend' => false, 'value' => false, 'checked' => cochéOuPasCoché($type_paiement, PAYPAL_DIFFERE), 'disabled' => 'disabled'));
	?>
</div>
<?php
echo $this->Form->end(__('Effectuer le paiement', true));
?>
