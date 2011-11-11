<?php 
 
 /*if (isset($_POST["nomboutont"]){
 
 }*/
 	
	echo $form->create(null);?>
	
	<h3><?php echo __('Antécédents médicaux',true); ?></h3>
	<?php
	
	$count = 0;
	$tab = array(0 => array(),1 => array(), 2 => array());
	$tab1 = array(0 => array(),1 => array(), 2 => array());
	
	foreach($maladies as $valeur)
	{
		
		$tab[$count % 3][] =  array($valeur['Maladie']['id'] =>$valeur['Maladie']['nom']);
		
		$count++;
	}
	
	
	//pr($maladies);
	$tab[2][] = "autre";
	?>
	
	<?php
	
	//echo $form->input('Model.name', array('multiple' => 'checkbox', 'options' => $options, 'selected' => $selected));
	 echo $this->Form->input('antecedent1', array('type'=>'select', 'multiple'=>'checkbox','options'=>$tab[0],'label' => false, 'selected' => $antecedents ));?>
	 </td><td>
	<?php echo $this->Form->input('antecedent2', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab[1], 'label'=>false, 'selected' => $antecedents)); ?>
	</td><td>
	<?php echo $this->Form->input('antecedent3', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab[2],'label'=>false, 'selected' => $antecedents));
	echo $form->input(' ',array('disabled'=> 'disabled'));?>
	
	</td></tr></table></br> 
	<h3><?php __('Questions générales sur votre jeune',true);?></h3>
	
	
	
	<table><tr><th></th><th>
	<?php
	$question = array();
	echo $form->label('oui',__('Oui',true)). $form->label('non',__('Non',true));?>
	</th></tr>
	<?php
	foreach($questions as $value){
		
		echo '<tr><td>'. $value['QuestionGenerale']['texte'].'</td><td>'.$form->radio('q'.$value['QuestionGenerale']['id'], 
			array('O' => '','N' => ''), 
			array('label'=> false, 'legend' => false));
		echo '</td></tr>';
	}
	?>
	

	
	</table></td></tr><td><tr>
	
	<table><tr><td><h3><?php echo __('Médicament(s) autorisé(s)',true) ;?>
	<h3> </td><td><h3>
	<?php echo __('Médicament(s) sous prescription avec posologie ',true);?>
	</h3></td></tr>
	<?php
	$tab = array();
	
	foreach($medicaments as $valeur){
		$tab[] = array($valeur['Medicament']['id'] => $valeur['Medicament']['nom']);
	}
	
	
?>	
	<tr><td>
	<?php echo $this->Form->input('medicamentautorise', array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab, 'label'=>' ','selected' => $resultmedicaments));?></td>
	<td><?php echo $form->input(' ', array('type' => 'textarea', true));?> </td></tr>
	<tr><td> <h3><?php echo __('Allergie(s)',true) ;?></h3> 
	<?php echo $form->input(' ', array('type' => 'textarea', true));?> </td></tr>
	<tr><td><h3><?php echo __('Peur(s) et phobie(s)',true);?> </h3>
	<?php echo $form->input(' ', array('type' => 'textarea', true));?></td></tr>
	</table>
	<?php echo $form->button('Étape précédente', array('type'=>'submit','name' => 'precedent'));
	echo $form->button('Étape suivante', array('type'=>'submit','name' => 'suivant'));
	
	echo $form->end();
	
?>
