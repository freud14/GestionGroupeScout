<?php
	echo '<table>'.
		'<tr>'.
		'<td >';
		 echo $form->create('ListeUnite', array('url' => array('controller' => 'ListeUnite', 'action' => 'assigner')));
		 echo $this->Form->input(__('Afficher',true), array('type' => 'select', 'options' => $option));

	echo '</td>'.
		'<td >';
			echo $this->Form->button(__('Voir', true), array('type'=>'summit')); 
			echo $form->end();
	echo'</td>'.
		'</tr>'.
		'</table>';
?> 


	<h3><?php echo __('Liste des filles',true); ?></h3>
	<table border=1><tr><th style ="width:200px"><?php echo __('Nom',true); ?></th>
	<th style ="width:120px"><?php echo __('Sexe',true); ?></th>
	<th style ="width:120px"><?php echo __('Âge',true); ?></th>
	<th style ="width:150px"><?php echo __('Groupe âge',true); ?></th>
	<th style ="width:120px"> <?php echo __('Sélectionner',true); ?></th>
	</tr>

<?php 

	echo $form->create('Assigner', array('url' => array('controller' => 'ListeUnite', 'action' => 'assigner')));
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
							 'selected' => $tab, 
							 'label' =>' '	
							)
				    	     );
		?> </tr></td><?php
	} ?>
	
	</table>
	<h3> 
</div>
<div>

<table>
<?php

	echo '<table>'.
		'<tr>'.
		'<td >';

	
	echo '</td>'.
		'<td >';
	
	echo $this->Form->button(__('Retirer', true), array('type'=>'summit', 'name' => 'retirer')); 
	
	echo '</td>'.
		'<td >';
	
	echo $this->Form->input(__('',true), array('type' => 'select', 'options' => $option));

	echo '</td>'.
		'<td >';
	
	echo $this->Form->button(__('Assigner', true), array('type'=>'summit', 'name' => 'assigner')); 
	
	echo '</td>'.
		'</tr>'.
		'</table>';
	echo $form->end();
?>

</div>


<style type="text/css">
    .checkbox{
    display:inline;
    padding-left:50px;
    }
  </style>
