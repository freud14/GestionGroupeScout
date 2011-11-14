<script type="text/javascript">
	$(function() {
		$('#AdulteAddForm').validate({
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
	<?php echo $form->create('InscrireAdulte', array('url' => array('controller' => 'InscrireAdulte', 'action' => 'inscription')));?>

<h3><?php echo $form->label(__('Informations du compte', true)); ?> </h3>
<table border="0">
	<tr>
		<td >
		<?php
			echo $form->input('nom_utilisateur', array('label' => array('class' => 'element', 'text' => __('Courriel', true) . ' <span class="star">*</span>')));
			echo $form->input('mot_de_passe', array('label' => array('class' => 'element', 'text' =>__('Mot de passe', true) . ' <span class="star">*</span>')));
			echo $form->input('mot_de_passe_confirmation', array('label' => array('class' => 'element', 'text' =>__('Mot de passe', true) . ' <span class="star">*</span>')));
		?>
		</td>
		<td>
		<?php
	echo $this->Form->input(__('Implication', true), array('type'=>'select', 'multiple'=>'checkbox', 'options'=> $option, 'label'=>__('Souhaitez-vous vous impliquer ?', true)));
			echo $this->Form->input('description', array('label' => array('class' => 'element', 'text' =>__('Spécifier si autre', true))));
		?>
		</td>
	</tr>
	<tr>
		<td>
		
		<h3><?php echo $form->label(__('Informations personnelles', true)); ?> </h3>

		<?php

			echo $form->input('nom', array('label' => array('class' => 'element', 'text' =>__('Nom', true) . ' <span class="star">*</span>')));
			echo $form->input('prenom', array('label' => array('class' => 'element', 'text' =>__('Prénom', true) . ' <span class="star">*</span>')));
			echo $form->input('tel_maison', array('label' => array('class' => 'element', 'text' =>__('Téléphone à la maison', true) . ' <span class="star">*</span>')));
			echo $form->label('sexe', __('Sexe', true).' *', array('class' => 'element'));
			echo $form->radio('genre', array('M' => __('Masculin', true),'F' => __('Féminin', true)),array('label'=> false, 'legend' => false));
			echo $form->input('tel_bureau', array('label' => array('class' => 'element', 'text' =>__('Téléphone au bureau', true))));
			echo $form->input('poste_bureau', array('label' => array('class' => 'element', 'text' =>__('Numéro de poste du <br> téléphone au bureau', true))));
			echo '<br>';
			echo $form->input('tel_autre', array('label' => array('class' => 'element', 'text' =>__('Cellulaire', true))));
			echo $form->input('profession', array('label' => array('class' => 'element', 'text' =>__('Emploi', true))));
		?>
		</td>
		<td>
		<!--	?php echo '<h2>captcha à intégrer</h2>'; //$captchaTool->show(); ?>--> 
		</td>
	</tr>
</table>

<p align="right">

    <?php echo $this->Form->button(__('Annuler l\'inscription', true), array('type'=>'reset')); ?>
    <?php echo $this->Form->button(__('Valider l\'inscription', true), array('type'=>'submit')); ?>
	<?php echo $form->end();?>
</p>
	<p style="clear:left;padding-top: 16px;"><?php __('Les champs marqu&eacute;s d\'une &eacute;toile (<span class="star">*</span>) sont obligatoires.', true); ?></p>
</div>
