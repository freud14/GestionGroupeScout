<?php
echo $form->create('Assigner Animateur', array('url' => array('controller' => 'ListeUnite', 'action' => 'assigner_animateur')));
?>
<table>
        <?php
        foreach ($listeUnite as $id_unite => $valeur) {
                ?>
                <tr> 
                        <th> 
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
                        pr($listeAnimateur);
                        pr($valeur['adulte']);
                        ?>
                        
                </td>
        </tr>
        <?php
}


echo $form->end();
?>

</div>


<style type="text/css">
        .checkbox{
                padding-left:50px;
        }
</style>
