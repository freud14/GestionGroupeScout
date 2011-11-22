<div>
	<?php echo $form->create('InscrireAdulte', array('url' => array('controller' => 'Inscrire_adulte', 'action' => 'profil')));?>

<h3><?php echo $form->label(__('Informations du compte', true)); ?> </h3>
<table border="0">
	<tr>
		<td class="liste" >
		<?php
			echo $form->input('nom_utilisateur', array('value' => $profil['Compte']['nom_utilisateur'],'label' => array('class' => 'element',  'text' => __('Courriel', true) . ' <span class="star">*</span>')));
			echo $form->input('mot_de_passe', array('label' => array('class' => 'element', 'text' =>__('Nouveau mot de passe', true) . ' <span class="star">*</span>')));
			echo $form->input('mot_de_passe_confirmation', array('label' => array('class' => 'element', 'text' =>__('Confirmer mot de passe', true) . ' <span class="star">*</span>')));
		?>
		</td>
		<td class="liste">
		<?php
	echo $this->Form->input(__('Implication', true), array('type'=>'select', 'multiple'=>'checkbox', 'options'=> $option,  'selected'=> $profil['Implication'][0]['id'],'label'=>__('Souhaitez-vous vous impliquer ?', true)));
		?>
		</td>
	</tr>
	<tr>
		<td class="liste">
		
		<h3><?php echo $form->label(__('Informations personnelles', true)); ?> </h3>

		<?php
			echo __('<p style="font-size:x-small;">Téléphone ex. 555-555-5555</p>', true);
			echo $form->input('nom', array('value' => $profil['Adulte']['nom'], 'label' => array('class' => 'element', 'text' =>__('Nom', true) . ' <span class="star">*</span>')));
			echo $form->input('prenom', array('value' => $profil['Adulte']['prenom'], 'label' => array('class' => 'element', 'text' =>__('Prénom', true) . ' <span class="star">*</span>')));
			echo $form->input('tel_maison', array('value' => $profil['Adulte']['tel_maison'],'label' => array('class' => 'element', 'text' =>__('Téléphone à la maison', true) . ' <span class="star">*</span>')));
			echo $form->input('sexe', array(
				'before' => $form->label('sexe', __('Sexe', true).' <span class="star">*</span>', array('class' => 'element')),
				'separator' => ' ',
				'options' => array('1' => __('Masculin', true),'2' => __('Féminin', true)),
				'type' => 'radio',
				'legend' => false,
				'default'=> $profil['Adulte']['sexe']
				)
			);
			echo $form->input('tel_bureau', array('value' => $profil['Adulte']['tel_bureau'],'label' => array('class' => 'element', 'text' =>__('Téléphone au bureau', true))));
			echo $form->input('poste_bureau', array('value' => $profil['Adulte']['poste_bureau'],'label' => array('class' => 'element', 'text' =>__('Numéro de poste du <br> téléphone au bureau', true))));
			echo '<br>';
			echo $form->input('tel_autre', array('value' => $profil['Adulte']['tel_autre'],'label' => array('class' => 'element', 'text' =>__('Cellulaire', true))));
			echo $form->input('profession', array('value' => $profil['Adulte']['profession'],'label' => array('class' => 'element', 'text' =>__('Emploi', true))));
		?>
		</td>
		<td class="liste">
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
