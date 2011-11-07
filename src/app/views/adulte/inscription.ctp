<?php $javascript->link('jquery-1.6.4.min.js'); ?>
<script type="text/javascript">
	$(function() {
		$('#AdultesAddForm').validate({
			'#AdultesNom_utilisateur': { 'rule' : 'notempty', 'error' : '<?php __('Attention, ce champ doit &#234;tre obligatoirement rempli.') ?>' },
			'#AdultesMot_de_passe': { 'rule' : 'notempty', 'error' : '<?php __('Attention, ce champ doit &#234;tre obligatoirement rempli.') ?>' },
			'#AdultesTel_maison': { 'rule' : 'notempty', 'error' : '<?php __('Attention, ce champ doit &#234;tre obligatoirement rempli.') ?>' },
		}, {
			'errorLocation' : 'appendLabel'
		});
		
		$("#AdultesTel_maison").mask("(999) 999-9999");

	});
</script>





<div>
	<?php echo $form->create('Adultes', array('url' => array('controller' => 'adultes', 'action' => 'inscription')));?>

<h3><?php __('Information du compte'); ?></h3>
<table border="1">
	<tr>
		<td>
		<?php
			echo $form->input('nom_utilisateur', array('label' => __('Courriel', true) . ' <span class="star">*</span>'));
			echo $form->input('mot_de_passe', array('label' => __('Mot de passe', true) . ' <span class="star">*</span>'));
			echo $form->input('mot_de_passe', array('label' => __('Mot de passe', true) . ' <span class="star">*</span>'));

		?>
		</td>
		<td>
		<?php
			echo $this->Form->input('check', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>array('Animation','Gestion / Comptabilité','Accompagnement','Couture, costumes', 'Cuisine (cuistot)', 'Autre'), 'label'=>'Souhaitez-vous vous impliquer ?'));
			echo $this->Form->input('description', array('label' => __('Spécifier si autre', true)));
		?>
		</td>
	</tr>
	<tr>
		<td>
		
		<h3><?php __('Information personnelle'); ?></h3>

		<?php
			echo $form->input('nom', array('label' => __('Nom', true) . ' <span class="star">*</span>'));
			echo $form->input('prenom', array('label' => __('Prénom', true) . ' <span class="star">*</span>'));
			echo $form->label('sexe', 'Sexe');
			echo $form->radio('gender', array('M' => 'Masculin','F' => 'Féminin'), array('label' => 'Sexe', 'legend' => false));
			echo $form->input('tel_maison', array('label' => __('Téléphone à la maison', true) . ' <span class="star">*</span>'));
			echo $form->input('tel__bureau', array('label' => __('Téléphone au bureau', true)));
			echo $form->input('poste__bureau', array('label' => __('Numéro de poste du <br> téléphone au bureau', true)));
			echo $form->input('tel_autre', array('label' => __('Cellulaire', true)));
			echo $form->input('profession', array('label' => __('Emploi', true)));
		?>
		</td>
		<td>
		</td>
	</tr>
</table>
    <?php echo $this->Form->button('Valider l\'inscription', array('type'=>'submit')); ?>
	<?php echo $form->end();?>

	<p style="clear:left;padding-top: 16px;"><?php __('Les champs marqu&eacute;s d\'une &eacute;toile (<span class="star">*</span>) sont obligatoires.'); ?></p>
</div>
