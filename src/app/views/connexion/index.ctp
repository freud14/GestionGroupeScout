<?php __('Entrez votre nom d\'utilisateur et votre mot de passe pour vous identifier:', true); ?>

<fieldset>
<legend> <?php echo __('Identification',true); ?> </legend>

<?php 

	echo $form->create('Connexion', array('url' => array('controller' => 'Connexion', 'action' => 'index')));
	echo $form->input('nom_utilisateur', array('label' => array('class' => 'element', 'text' => __('Courriel', true) . ' <span class="star">*</span>')));
	echo $form->label(__('Mot de passe*', true)); 
	
	echo '<br>';

	if ((isset($erreur)) && (!empty($erreur))){

		echo $erreur;
	}

    echo $this->Form->button(__('Identification', true), array('type'=>'submit')); 
?>
</fieldset>

