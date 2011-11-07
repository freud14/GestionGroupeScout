<?php 
	echo $form->create(null, array('action' => 'fiche_medicale')); 
		
	echo $form->input('nom', array('label' => 'Nom'));
	
	echo $form->input('prenom', array('label' => 'Prénom'));
			
	echo $form->label('sexe', 'Sexe');
	echo $form->radio('gender', 
			array('M' => 'Masculin','F' => 'Féminin'), 
			array('label' => 'Sexe', 'legend' => false));
	
	/*$elements = array();
	for($i = date('Y') - 70; $i = date('Y') - 5; ++$i) {
		$elements[] = $i;
	}
	
	
	echo $form->input('date_naissance', array('label' => 'Date de naissance',
							'dateFormat' => 'DMY',
							'minYear' => date('Y') - 70,
							'maxYear' => date('Y') - 5));*/
	echo "<br/>";
	echo $form->label('date_de_naissance', 'Date de naissance');
	echo $form->day('jour_naissance');
	echo $form->month('mois_naissance');						
	echo $form->year('annee_naissance', date('Y') - 70, date('Y') - 5);

	echo $form->input('assurance_maladie', array('label' => 'Numéro d\'assurance maladie'));
	echo $form->end("Étape suivante");
?>
