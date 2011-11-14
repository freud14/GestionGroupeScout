
<?php echo $form->create('InscrireAdulte', array('url' => array('controller' => 'InscrireAdulte', 'action' => 'view')));?>
<div>
	<?php echo (__('Votre inscription est maintenant terminée et vous êtes maintenant  identifié sur le site Voulez-vous commencer à inscrire votre ou vos enfants maintenant ? <br> <br>', true)); ?> 
</div>
	<?php echo $form->button('Non merci, aller à l\'accueil', array('type'=>'submit','name' => 'accueil'));
	echo $form->button('Commencer à inscrire un enfant', array('type'=>'submit', 'name' => 'inscrire'));?>

	<?php echo $form->end();?>

