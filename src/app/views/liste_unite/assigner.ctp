<?php
	echo '<table border="0">'.
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
<?php echo $this->Form->input(__('<h3>Féminin</h3>', true), array('type'=>'select', 'multiple'=>'checkbox', 'options'=> $optionF, 'label'=> null)) ;?>
<br><br>
<?php echo $this->Form->input(__('<h3>Masculin</h3>', true), array('type'=>'select', 'multiple'=>'checkbox', 'options'=> $optionM, 'label'=> null)) ;?>




<br>

</div>
