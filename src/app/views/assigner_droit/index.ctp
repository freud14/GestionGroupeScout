<?php 
 
 /*if (isset($_POST["nomboutont"]){
 
 }*/
 	
	echo $form->create(null);
	
	?>
	
	<h3><?php echo __('Liste du personnel',true); ?></h3>
	<table><tr><th style ="width:200px"><?php echo __('Nom',true); ?></th>
	<th style ="width:120px"><?php echo __('Animateur',true); ?></th>
	<th style ="width:120px"><?php echo __('Consultation',true); ?></th>
	<th style ="width:120px"><?php echo __('Administrateur',true); ?></th>
	<th style ="width:120px"><?php echo __('Pilote',true); ?></th>
	</tr>
	<?php 
	//$options = array('animateur' => '','consultation' => ' ','administrateur' => ' ','pilote' => ' ');
	$options = array('1' => '','2' => ' ','3' => ' ','4' => '');
	$attributes = array('multiple' => 'checkbox');
	
	foreach($membre as $id => $tab)
	{
		?>
		<tr><td> 
		<?php echo $tab['nom']; ?>
		</td><td colspan="4">
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
	<h3><?php echo __('Liste des membres',true); ?></h3>
	<table><tr><th style ="width:200px"><?php echo __('Nom',true); ?></th>
	<th style ="width:120px"><?php echo __('Animateur',true); ?></th>
	<th style ="width:120px"><?php echo __('Consultation',true); ?></th>
	<th style ="width:120px"><?php echo __('Administrateur',true); ?></th>
	<th style ="width:120px"><?php echo __('Pilote',true); ?></th>
	</tr>
	<?php
		foreach($nonMembre as $id => $tab)
	{
		?>
		<tr><td> 
		<?php echo $tab['nom']; ?>
		</td><td colspan="4">
		<?php echo $this->Form->input($id, array('type'=>'select', 
							 'multiple'=>'checkbox', 
							 'options' => $options, 
							 'label' =>' '	
							)
				    	     );
	
	?> </tr></td><?php
	
	
	} 
	?> </table><?php
	echo $form->button('Enregistrer', array('type'=>'submit','name' => 'enregistrer'));
	
	echo $form->end();
	
?>
<style type="text/css">
    .checkbox{
    display:inline;
    padding-left:50px;
    padding-right:55px;
   
    }
  </style>
