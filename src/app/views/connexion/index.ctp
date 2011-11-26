<?php __('Entrez votre nom d\'utilisateur et votre mot de passe pour vous identifier:', true); ?>

<fieldset>
<legend> <?php echo __('Identification',true); ?> </legend>

<?php 

	echo $form->create(null);
	echo $form->input('nom_utilisateur', array('label' => array('class' => 'element', 'text' => __('Courriel', true) . ' <span class="star">*</span>')));
	
	echo $form->input('mot_de_passe',array('label' => array('class' => 'element', 'text' => __('Mot de passe', true) . ' <span class="star">*</span>')));
	echo '<br>';

	if ((isset($erreur)) && (!empty($erreur))){

		echo $erreur;
	}

    	
	echo $form->button('Connexion', array('type'=>'submit','name' => 'connexion'));
        echo "<br><br>";
        echo $form->button('Nouvelle inscription', array('type'=>'submit','name' => 'inscrire'));
	echo $form->end();
?>
</fieldset>

