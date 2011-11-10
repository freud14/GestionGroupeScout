<?php 

	echo $form->create(null, array('action' => 'autorisation')); 
	echo '<h3>' .__('Antécédents médicaux',true). '</h3>';
	$count = 0;
	$tab = array(0 => array(),1 => array(), 2 => array());
	
	foreach($maladies as $value)
	{
		
		$tab[$count % 3][] = $value['Maladie']['nom'];
		$count++;
	}
	
	
	
	$tab[2][] = "autre";
	
	
	echo '<table><tr><td>';
	echo $this->Form->input('done', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab[0], 'label'=>' '));
	echo '</td><td>';
	echo $this->Form->input('done1', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab[1], 'label'=>' '));
	echo '</td><td>';
	echo $this->Form->input('done2', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab[2], 'label'=>' '));
	echo $form->input(' ',array('disabled'=> 'disabled'));
	
	echo '</td></tr></table></br>';
	echo '<h3>'. __('Questions générales sur votre jeune',true). '</h3>';
	
	$tab = array();
	
	foreach($questions as $value){
		$tab[] = $value['QuestionGenerale']['texte'];
	}
	
	echo '<table><tr><th></th><th>'.$form->label('oui',__('Oui',true)). $form->label('non',__('Non',true)).'</th></tr>';
	foreach($tab as $valeur){
		echo '<tr><td>'. $valeur.'</td><td>'.$form->radio('gender', 
			array('O' => '','N' => ''), 
			array('label'=> false, 'legend' => false));
		echo '</td></tr>';
		
	}
	echo '</table></td></tr><td><tr>';
	
	echo '<table><tr><td><h3>'. __('Médicament(s) autorisé(s)',true) . '<h3> </td><td><h3>'.
	__('Médicament(s) sous prescription avec posologie ',true). '</h3></td></tr>';
	$tab = array();
	
	foreach($medicaments as $value){
		$tab[] = $value['Medicament']['nom'];
	}
	
	
	
	echo '<tr><td>'.$this->Form->input('medicamentautorise', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab, 'label'=>' ')).'</td><td>';
	echo $form->input(' ', array('type' => 'textarea', true)). '</td></tr>';
	echo '<tr><td> <h3>' . __('Allergie(s)',true) .'</h3>' .$form->input(' ', array('type' => 'textarea', true)). '</td></tr>';
	echo '<tr><td><h3>' . __('Peur(s) et phobie(s)',true) .'</h3>'. $form->input(' ', array('type' => 'textarea', true)).'</td></tr>';
	echo '</table>';
	
	echo $form->end('Étape suivante', true);
	
?>
