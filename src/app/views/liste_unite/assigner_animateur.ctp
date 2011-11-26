<?php
echo $form->create('Assigner Animateur', array('url' => array('controller' => 'ListeUnite', 'action' => 'assigner_animateur')));
?>
<table>
        <?php
        foreach ($listeUnite as $id_unite => $valeur) {
        ?>
        <tr> 
                <th style="text-align: left;padding-left: 50px"> 
        <h3>
                <?php echo $valeur['nom']; ?>
        </h3>
</th>
</tr>
<tr>
        <td>
                <?php
                echo $this->Form->input($id_unite, array('type' => 'select',
                'multiple' => 'checkbox',
                'options' => $listeAnimateur,
                'label' => false,
                'selected' => $valeur['adulte']));
               
                ?>

        </td>
</tr>
<?php
}
?>
<tr> 
        <td style="text-align: right">
                <?php
echo $form->button(__('Assigner',true), array('type'=>'submit','name' => 'assigner'));
echo $form->end();
?>
        </td>
</tr>
<?php
/*
  echo '<table>'.
  '<tr>'.
  '<td >';
  echo $form->create('Animateur', array('url' => array('controller' => 'ListeUnite', 'action' => 'assigner_animateur')));
  echo $this->Form->select('Afficher', $option, null, array('empty' => false));

  echo '</td>'.
  '<td >';
  echo $this->Form->button(__('Voir', true), array('type'=>'summit', 'name' => 'voir'));
  echo'</td>'.
  '</tr>'.
  '</table>';
  ?>


  <table border=1><tr><th style ="width:200px"><?php echo __('Prenom / Nom',true); ?></th>
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
  '<td >';


  echo '</td>'.
  '<td >';

  echo $this->Form->button(__('Retirer', true), array('type'=>'summit', 'name' => 'retirer'));

  echo '</td>'.
  '<td >';
  //Select au lieu d'un input pour avoir un index dans le $this->data
  echo $this->Form->select('assignation', $optionAssignation, null, array('empty' => false));

  echo '</td>'.
  '<td >';

  echo $this->Form->button(__('Assigner', true), array('type'=>'summit', 'name' => 'assigner'));

  echo '</td>'.
  '</tr>'.
  '</table>';
  echo $form->end();
  >>>>>>> f3121affb0d876d937e52903614990acda269d06
  ?>

  </div> */

?>
<style type="text/css">

.checkbox{
padding-left:100px;
}

