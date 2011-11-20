<?php
App::import('Sanitize');
?>
<h3>Liste des parents</h3>
<?php
echo $this->Form->create(NULL);
?>
<?php
echo $this->Form->input('recherche', array('label' => array('class' => 'element', 'text' => 'Rechercher un parent'), 'div' => false));
?>

<?php
echo $this->Form->submit(__('Rechercher', true), array('div' => false));
echo $this->Form->end();
?>
<br />
<?php
if (isset($recherche)) {
	if (!empty($statuts)) {
		echo sprintf(__('Vous avez recherché <strong>%s</strong>. ', true), Sanitize::html($recherche));
	} else {
		echo sprintf(__('Aucun résultat n\'a été trouvé pour « <strong>%s</strong> ». ', true), Sanitize::html($recherche));
	}
	echo $this->Html->link(__('Afficher tous les résutats ?', true), array('controller' => 'paiement_membre', 'action' => ''));
}
?>
<?php if (!empty($statuts)) { ?>
	<p>
	<table class="tableau_generique">
		<tr>
			<th><?php __('Nom'); ?></th>
			<th><?php __('Courriel'); ?></th>
			<th><?php __('Téléphone'); ?></th>
			<th><?php __('Statut du paiement'); ?></th>
			<th><?php __('Modifier'); ?></th>
		<tr>
	<?php foreach ($statuts as $statut) { ?>
			<tr>
				<td><?php echo $statut['Adulte']['prenom'] . ' ' . $statut['Adulte']['nom']; ?></td>
				<td><?php echo empty($statut['Adulte']['courriel']) ? "Pas de courriel" : $statut['Adulte']['courriel']; ?></td>
				<td><?php echo $statut['Adulte']['tel_maison']; ?></td>
		<?php
		$stat = __('Impayé', true);
		if ($statut[0]['montant_total'] == $statut[0]['montant_paye'] &&
				$statut[0]['nb_inscription'] == $statut[0]['nb_facture']) {
			$stat = __('Payé', true);
		}
		?>
				<td><?php echo $stat; ?></td>
				<td><?php echo $this->Html->link('Modifier', array('controller' => 'gestionnaire_paiement', 'action' => 'index', $statut['Adulte']['id'])); ?></td>
			</tr>
	<?php } ?>

	</table></p>
<?php } ?>
