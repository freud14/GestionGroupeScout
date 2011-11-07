<?php 

	echo $form->create(null, array('action' => 'autorisation')); 
	echo '<h3>' .__('Antécédents médicaux',true). '</h3>';
	$num  = 7;
	$tab = array('test1','test2','test3','test4','test5','test6','test7');
	$tab1 = array();
	$tab2 = array();
	$tab3 = array();
	if ( $num % 3 == 0){
		;
		
		for ( $i = 0; $i < $num /3;$i++){
			$tab1[] = $tab[$i];
			$tab2[] = $tab[$i + $num/3]; 
			$tab3[] = $tab[$i + ($num/3 *2)];
		}
	}elseif ( $num % 3 == 1 ){
		for ( $i = 0; $i < ($num - 1) /3;$i++){
			$tab1[] = $tab[$i];
			$tab2[] = $tab[$i + $num/3]; 
			$tab3[] = $tab[$i + ($num/3 *2)];
		}
		$tab1[] = $tab[$num -1];
	}else if( $num % 3 == 2 ){
		for ( $i = 0; $i < ($num - 2) /3;$i++){
			$tab1[] = $tab[$i];
			$tab2[] = $tab[$i + $num/3]; 
			$tab3[] = $tab[$i + ($num/3 *2)];
		}
		$tab1[] = $tab[$num - 2];
		$tab2[] = $tab[$num - 1];
	}
	
	$tab3[] = "autre";
	
	
	echo '<table><tr><td>';
	echo $this->Form->input('done', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab1, 'label'=>' '));
	echo '</td><td>';
	echo $this->Form->input('done1', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab2, 'label'=>' '));
	echo '</td><td>';
	echo $this->Form->input('done2', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab3, 'label'=>' '));
	echo $form->input(' ',array('disabled'=> 'disabled'));
	
	echo '</td></tr></table></br>';
	echo '<h3>'. __('Question générales sur votre jeune',true). '</h3>';
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
	echo '</table>';
		
	
?>
