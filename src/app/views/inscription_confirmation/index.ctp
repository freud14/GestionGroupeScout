<?php 
 echo $form->create(null);
 
 echo __('L\'inscription de '. $nom .' est maintenant terminée. Vous pouvez dès maintenant payer en ligne ou ajouter un autre enfant.
	Pour ce qui est du paiement, vous pouvez également aller payer en personne à nos locaux.');
	?>
	<br><br><br>
	<?php
	echo $form->button('Inscrire un autre enfant', array('type'=>'submit','name' => 'inscription'));
	echo $form->button('Procéder au paiement', array('type'=>'submit','name' => 'paiement'));
	echo $form->button('Aller à la page d\'accueil', array('type'=>'submit','name' => 'accueil'));
	echo $form->end();
	
	
 /*if (isset($_POST["nomboutont"]){
 
 }
 	
	
	
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
	 echo $this->Form->input('antecedent1', 
	 			array('type'=>'select', 'multiple'=>'checkbox','options'=>$tab[0], 'label' => false, 'selected' => $antecedents ));?>
	 </td><td>
	<?php echo $this->Form->input('antecedent2', 
				array('type'=>'select', 'multiple'=>'checkbox', 'options'=>$tab[1], 'label'=>false, 'selected' => $antecedents)); ?>
	</td><td>
	<?php echo $this->Form->input('antecedent3', 
				array('type'=>'select','multiple'=>'checkbox', 'options'=>$tab[2],'label'=>false, 'selected' => $antecedents));
	echo $form->input(' ',array('disabled'=> 'disabled'));?>
	
	</td></tr></table></br> 
	
	<h3>
	<?php echo __('Questions générales sur votre jeune',true);?></h3>
	
	<table><tr><th></th><th>
	<?php
	$question = array();
	echo $form->label('oui',__('Oui',true)). $form->label('non',__('Non',true));?>
	</th></tr>
	<?php
		
	echo $this->Form->radio('antecedent23', 
			array(1 => '', 2 => ''),
			array( 'legend' => false,'label' => false)); 
	//test
	/*echo $form->input('describeJob', array('label' => false,'div' => false,'type' => 'select','multiple'=>'checkbox','legend' => 'false','options' =>
	  array('Physical' => 'Physical','Mental' => 'Mental', 'Stressful' => 'Stressful',  'Easy-going' => 'Easy-going', 
	  'Secure' => 'Secure', 'Non-secure' => 'Non-secure', 'Exhausting' => 'Exhausting', 'Relaxing' => 'Relaxing' ),
	      )); 
	$tab = array();
	foreach($questions as $value){
		$tab[] = array($value['QuestionGenerale']['id'] => $value['QuestionGenerale']['texte']);
		/*echo '<tr><td>'. $value['QuestionGenerale']['texte'].'</td><td>'.$form->radio('q'.$value['QuestionGenerale']['id'], 
			array('O' => '','N' => ''),
			array('label'=> false, 'legend' => false));
		echo '</td></tr>';
	}
	?>
	<tr><td></td></tr>

	
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
	
	<?php echo $this->Form->input('medicamentautorise', array('type'=>'select', 
	'multiple'=>'checkbox', 'options'=>$tab, 'label'=>' ','selected' => $resultmedicaments));?>
	
	</td>
	<td><?php echo $form->input(' ', array('type' => 'textarea', true));?> </td></tr>
	<tr><td> <h3><?php echo __('Allergie(s)',true) ;?></h3> 
	<?php echo $form->input(' ', array('type' => 'textarea', true));?> </td></tr>
	<tr><td><h3><?php echo __('Peur(s) et phobie(s)',true);?> </h3>
	<?php echo $form->input(' ', array('type' => 'textarea', true));?></td></tr>
	</table>
	<?php echo $form->button('Étape précédente', array('type'=>'submit','name' => 'precedent'));
	echo $form->button('Étape suivante', array('type'=>'submit','name' => 'suivant'));
	
	echo $form->end();
	
?>*/
