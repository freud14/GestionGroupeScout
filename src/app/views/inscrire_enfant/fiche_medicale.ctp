<?php 

	echo $form->create(null, array('action' => 'autorisation')); 
	echo '<h3>' .__('Antécédents médicaux',true). '</h3>';
	$count = 0;
	$tab = array(0 => array(),1 => array(), 2 => array());
	pr($maladies);
	foreach($maladies as $value)
	{
		
		$tab[$count % 3][] = $value['Maladie']['nom'];
		$count++;
	}
	
	//pr($maladies);
	/*if ( $count % 3 == 0)
	{
		for (int $i; $i < 
	}
	//foreach($maladies as $value){
	//	$tab1[] = $value;
	
	//}
	
	$tab2 = array();
	$tab3 = array();
	/*if ( $num % 3 == 0){
		;
		
		for ( $i = 0; $i < $num /3;$i++){
			$tab1[] = $maladies[$i];
			$tab2[] = $maladies[$i + $num/3]; 
			$tab3[] = $maladies[$i + ($num/3 *2)];
		}
	}elseif ( $num % 3 == 1 ){
		for ( $i = 0; $i < ($num - 1) /3;$i++){
			$tab1[] = $maladies[$i];
			$tab2[] = $maladies[$i + $num/3]; 
			$tab3[] = $maladies[$i + ($num/3 *2)];
		}
		$tab1[] = $maladies[$num -1];
	}else if( $num % 3 == 2 ){
		for ( $i = 0; $i < ($num - 2) /3;$i++){
			$tab1[] = $maladies[$i];
			$tab2[] = $maladies[$i + $num/3]; 
			$tab3[] = $maladies[$i + ($num/3 *2)];
		}
		$tab1[] = $maladies[$num - 2];
		$tab2[] = $maladies[$num - 1];
	}
	
	$tab3[] = "autre";
	*/
	
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
	$tab[] = 'question 1';
	$tab[] = 'question 2';
	
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
	$tab[] = 'med aut1';
	$tab[] = 'med aut2';
	echo '<tr><td>'.$this->Form->input('medicamentautorise', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab, 'label'=>' ')).'</td><td>';
	echo $form->input(' ', array('type' => 'textarea', true)). '</td></tr>';
	echo '<tr><td> <h3>' . __('Allergie(s)',true) .'</h3>' .$form->input(' ', array('type' => 'textarea', true)). '</td></tr>';
	echo '<tr><td><h3>' . __('Peur(s) et phobie(s)',true) .'</h3>'. $form->input(' ', array('type' => 'textarea', true)).'</td></tr>';
	echo '</table>';
	
	echo $form->end('Étape suivante', true);
	
?>
