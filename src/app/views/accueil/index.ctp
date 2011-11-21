
<?php __('Entrez votre nom d\'utilisateur et votre mot de passe pour vous identifier:', true); ?>

<fieldset>
<legend> <?php echo __('Accueil',true); ?> </legend>

<?php 

	echo $form->button('Accueil', array('type'=>'submit','name' => 'connexion'));
	echo $form->end();
?>
</fieldset>

