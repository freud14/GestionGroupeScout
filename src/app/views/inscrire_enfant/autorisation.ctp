<?php 

	echo $form->create(null, array('action' => 'autorisation')); 
	
	
	echo $form->label('champsobligatoires',__('Les champs suivis d\'une étoile (*) sont obligatoires',true));
	echo '<h3>' .__('Autorisation des baignades',true). '</h3>';
	$tab = array();
	$tab[] = 'Moi, Robert Paquet, accepte que Maxime se baigne sous la surveillance des animateurs du 102e Groupe scout des Laurentildes.';
	echo $this->Form->input('message1', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab, 'label'=>' '));
	$tab = array();
	echo '<br><h3>' .__('Autorisation de photos',true). '</h3><br>';
	$tab[] = 'Moi, Robert Paquet, accepte que 102e Groupe scout des Laurentildes et le District de Québec publient des photos anonymes de Maxime dans le but de faire la promotion du scoutisme.';
	echo $this->Form->input('message2', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab, 'label'=>' '));
	
	echo '<br><br>'.$form->label('avetissement1',__('Prenez note que ces autorisations sont valides pour la durée totale de 
	l\'inscription c\'est-à-dire jusqu\'à la fin de l\'année scout et qu\'il n\'est pas possible de les retirer.',true));
	
	?> <br><br><br><br> <?php __('En cliquant sur le bouton « Accepter et valider l\'inscription » d\'un jeune au mouvement 
	scout implique scout implique certaines responsabilités pour le parent. Vous comprenez également que vous aurez à participer à certains financements, à fournir du transport 
	à l\'occasion et à participer à des réunions de parents au cours de l\'année.',true);
	?>
	<br><br>
	<?php 
	echo $form->input('motdepassestr', array('label' => array('class' => 'element', 'text' => __('Entrez votre mot de passe', true).' <span class="star">*</span>')));?>
	<br><br>
	 
	<?php 
	echo $form->button('Annuler l\'inscription', array('type'=>'submit','name' => 'annuler'));
	echo $form->button('Étape précédente', array('type'=>'submit','name' => 'precedent'));
	echo $form->button('Accepter et valider l\'inscription', array('type'=>'submit','name' => 'accepter'));
	
	echo $form->end();
	?>

