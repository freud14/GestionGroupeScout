<?php 
 echo $form->create(null);
 
 echo __('L\'inscription de '. '<strong>' .  $nom . '</strong>'  .' est maintenant terminée. Vous pouvez dès maintenant payer en ligne ou ajouter un autre enfant.
	Pour ce qui est du paiement, vous pouvez également aller payer en personne à nos locaux.');
	?>
	<br><br><br>
	<?php
	echo $form->button('Inscrire un autre enfant', array('type'=>'submit','name' => 'inscription'));
	echo $form->button('Procéder au paiement', array('type'=>'submit','name' => 'paiement'));
	echo $form->button('Aller à la page d\'accueil', array('type'=>'submit','name' => 'accueil'));
	echo $form->end();
?>