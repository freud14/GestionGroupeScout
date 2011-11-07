<?php 

	echo $form->create(null, array('action' => 'autorisation')); 
	echo '<h2>';
	echo $form->label('antecedentmedicaux', 'Antécédents médicaux');
	echo '</h2>';
	$num  = 7;
	$arr = array('test1','test2','test3','test4','test5','test6','test7');
	$arr1 = array();
	$arr2 = array();
	$arr3 = array();
	if ( $num % 3 == 0){
		;
		
		for ( $i = 0; $i < $num /3;$i++){
			$arr1[] = $arr[$i];
			$arr2[] = $arr[$i + $num/3]; 
			$arr3[] = $arr[$i + ($num/3 *2)];
		}
	}elseif ( $num % 3 == 1 ){
		for ( $i = 0; $i < ($num - 1) /3;$i++){
			$arr1[] = $arr[$i];
			$arr2[] = $arr[$i + $num/3]; 
			$arr3[] = $arr[$i + ($num/3 *2)];
		}
		$arr1[] = $arr[$num -1];
	}else if( $num % 3 == 2 ){
		for ( $i = 0; $i < ($num - 2) /3;$i++){
			$arr1[] = $arr[$i];
			$arr2[] = $arr[$i + $num/3]; 
			$arr3[] = $arr[$i + ($num/3 *2)];
		}
		$arr1[] = $arr[$num - 2];
		$arr2[] = $arr[$num - 1];
	}
	echo '<table><tr><td>';
	echo $this->Form->input('done', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$arr1, 'label'=>'test1'));
	echo '</td><td>';
	echo $this->Form->input('done', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$arr2, 'label'=>'test2'));
	echo '</td><td>';
	echo $this->Form->input('done', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$arr3, 'label'=>'test3'));
	echo '</td></tr></table>';
	echo '</br>';
	
		
	
?>
