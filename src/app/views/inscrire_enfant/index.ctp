<script>
	/*$(document).ready(function() {
		$("div.error").
	});*/

</script>

<?php
	echo $form->create(null); //, array('action' => 'fiche_medicale')); 
?>

<?php
	echo $form->input('nom', array('label' => array('class' => 'element', 'text' => __('Nom', true).' <span class="star">*</span>')));
?>

<?php
	echo $form->input('prenom', array('label' => array('class' => 'element', 'text' => __('Prénom', true).' <span class="star">*</span>')));
?>

<?php
	echo $form->label('sexe', __('Sexe', true).' <span class="star">*</span>', array('class' => 'element'));
	echo $form->radio('gender', 
			array('M' => __('Masculin', true),'F' => __('Féminin', true)), 
			array('label'=> false, 'legend' => false));
?>

<?php
	/*$elements = array();
	for($i = date('Y') - 70; $i = date('Y') - 5; ++$i) {
		$elements[] = $i;
	}
	
	
	echo $form->input('date_naissance', array('label' => 'Date de naissance',
							'dateFormat' => 'DMY',
							'minYear' => date('Y') - 70,
							'maxYear' => date('Y') - 5));*/
?>

<?php
	echo "<br/>";
	echo $form->label('date_de_naissance', __('Date de naissance', true).' <span class="star">*</span>', array('class' => 'element'));
	echo $form->day('jour_naissance');
	echo $form->month('mois_naissance');						
	echo $form->year('annee_naissance', date('Y') - 70, date('Y') - 5);
?>

<?php
	echo $form->input('assurance_maladie', array('label' => array('class' => 'element', 'text' => __('Numéro d\'assurance maladie', true).' <span class="star">*</span>')));
?>

<?php
	echo $form->label('adresse', __('Adresse', true).' <span class="star">*</span>', array('class' => 'element'));
	echo $form->textarea('adresse', array('rows' => 7, 'cols' => 35));
?>

<?php
	echo $form->end(__('Étape suivante', true));
?>
