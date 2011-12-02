<?php
	echo '<table>'.
		'<tr>'.
		'<td >';
		 echo $form->create('Assigner', array('url' => array('controller' => 'ListeUnite', 'action' => 'assigner')));
		 echo $this->Form->select('Afficher', $option, null, array('empty' => false));

	echo '</td>'.
		'<td >';
			echo $this->Form->button(__('Voir', true), array('type'=>'summit', 'name' => 'voir')); 
	echo'</td>'.
		'</tr>'.
		'</table>';
?> 


	<table border=1><tr><th style ="width:200px"><?php echo __('Prenom / Nom',true); ?></th>
	<th style ="width:120px"><?php echo __('Sexe',true); ?></th>
	<th style ="width:120px"><?php echo __('Âge',true); ?></th>
	<th style ="width:150px"><?php echo __('Groupe âge',true); ?></th>
	<th style ="width:120px"> <?php echo __('Sélectionner',true); ?></th>
	</tr>

<h3> <?php echo $titreUnite ?> </h3>


<?php 

	$options = array('1' => '');
	
	foreach($enfant as $id => $tab)	{
		?>
		<tr><td> 
		<?php echo $tab['nom']; ?>
		<td> 
		<?php 
			if($tab['sexe'] == 1){
				echo "M";
			}else{
				echo "F";
			}?>
		<td> 
		<?php echo $tab['naissance']; ?>
		<td> 
		<?php echo $tab['groupe']; ?>
		</td><td>
		<?php echo $this->Form->input($id, array('type'=>'select', 
							 'multiple'=>'checkbox', 
							 'options' => $options, 
							 'label' =>' ')
				    	     );
		echo'</tr></td>';
	} ?>
	
	</table>
	<h3> 
</div>
<div>

<table>
<?php

	echo '<table>'.
		'<tr>'.
		'<th >';

	
	echo '</th>'.
		'<td style ="width:504px">';
	
	echo $this->Form->button(__('Retirer', true), array('type'=>'summit', 'name' => 'retirer')); 
	
	echo '</th>'.
		'<th >';

	//Select au lieu d'un input pour avoir un index dans le $this->data
	echo $this->Form->select('assignation', $optionAssignation, null, array('empty' => false));

	echo '</th>'.
		'<th >';
	
	echo $this->Form->button(__('Assigner', true), array('type'=>'summit', 'name' => 'assigner')); 
	
	echo '</th>'.
		'</tr>'.
		'</table>';
	echo $form->end();
?>

</div>


<style type="text/css">
    .checkbox{
    padding-left:50px;
    }
  </style>
