<div>
	<?php echo $form->create('InscrireAdulte', array('url' => array('controller' => 'InscrireAdulte', 'action' => 'index')));?>

<h3><?php echo $form->label(__('Informations du compte', true)); ?> </h3>
<table border="0">
	<tr>
		<td class="liste" >
		<?php
			echo $form->input('nom_utilisateur', array('value' => $profil[0]['Compte']['nom_utilisateur'],'label' => array('class' => 'element',  'text' => __('Courriel', true) . ' <span class="star">*</span>')));
			echo $form->input('mot_de_passe', array('label' => array('class' => 'element', 'text' =>__('Nouveau mot de passe', true) . ' <span class="star">*</span>')));
			echo $form->input('mot_de_passe_confirmation', array('label' => array('class' => 'element', 'text' =>__('Confirmer mot de passe', true) . ' <span class="star">*</span>')));
		?>
		</td>
		<td class="liste">
		<?php
	echo $this->Form->input(__('Implication', true), array('type'=>'select', 'multiple'=>'checkbox', 'options'=> $option,  'selected'=> $profil[0]['Adulte'][0]['Implication'][0]['id'],'label'=>__('Souhaitez-vous vous impliquer ?', true)));
		?>
		</td>
	</tr>
	<tr>
		<td class="liste">
		
		<h3><?php echo $form->label(__('Informations personnelles', true)); ?> </h3>

		<?php
			echo __('<p style="font-size:x-small;">Téléphone ex. 555-555-5555</p>', true);
			echo $form->input('nom', array('value' => $profil[0]['Adulte'][0]['nom'], 'label' => array('class' => 'element', 'text' =>__('Nom', true) . ' <span class="star">*</span>')));
			echo $form->input('prenom', array('value' => $profil[0]['Adulte'][0]['prenom'], 'label' => array('class' => 'element', 'text' =>__('Prénom', true) . ' <span class="star">*</span>')));
			echo $form->input('tel_maison', array('value' => $profil[0]['Adulte'][0]['tel_maison'],'label' => array('class' => 'element', 'text' =>__('Téléphone à la maison', true) . ' <span class="star">*</span>')));
			echo $form->input('sexe', array(
				'before' => $form->label('sexe', __('Sexe', true).' <span class="star">*</span>', array('class' => 'element')),
				'separator' => ' ',
				'options' => array('M' => __('Masculin', true),'F' => __('Féminin', true)),
				'type' => 'radio',
				'legend' => false,
				'default'=> $profil[0]['Adulte'][0]['sexe']
				)
			);
			echo $form->input('tel_bureau', array('value' => $profil[0]['Adulte'][0]['tel_bureau'],'label' => array('class' => 'element', 'text' =>__('Téléphone au bureau', true))));
			echo $form->input('poste_bureau', array('value' => $profil[0]['Adulte'][0]['poste_bureau'],'label' => array('class' => 'element', 'text' =>__('Numéro de poste du <br> téléphone au bureau', true))));
			echo '<br>';
			echo $form->input('tel_autre', array('value' => $profil[0]['Adulte'][0]['tel_autre'],'label' => array('class' => 'element', 'text' =>__('Cellulaire', true))));
			echo $form->input('profession', array('value' => $profil[0]['Adulte'][0]['profession'],'label' => array('class' => 'element', 'text' =>__('Emploi', true))));
		?>
		</td>
		<td class="liste">
		<!--	?php echo '<h2>captcha à intégrer</h2>'; //$captchaTool->show(); ?>--> 
		</td>
	</tr>
</table>

<p align="right">

    <?php echo $this->Form->button(__('Annuler', true), array('type'=>'reset')); ?>
    <?php echo $this->Form->button(__('Mettre à jour', true), array('type'=>'submit')); ?>
	<?php echo $form->end();?>
</p>
	<p style="clear:left;padding-top: 16px;"><?php __('Les champs marqu&eacute;s d\'une &eacute;toile (<span class="star">*</span>) sont obligatoires.', true); ?></p>
</div>
