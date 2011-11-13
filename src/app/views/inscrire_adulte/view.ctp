
	<?php echo $form->create('InscrireAdulte', array('url' => array('controller' => 'InscrireAdulte', 'action' => 'view')));?>
<?php echo $form->create('InscrireAdulte', array('url' => array('controller' => 'InscrireAdulte', 'action' => 'view')));?>
	<h3><?php echo $form->label(__('Votre inscription est maintenant terminée et vous êtes maintenant  identifié sur le site. <br><br> Voulez-vous commencer à inscrire votre ou vos enfants maintenant ?', true)); ?> </h3>
	<?php echo $form->button('Non merci, aller à l\'accueil', array('type'=>'submit','name' => 'accueil'));
	echo $form->button('Commencer à inscrire un enfant', array('type'=>'submit', 'name' => 'inscrire'));?>

	<?php echo $form->end();?>

