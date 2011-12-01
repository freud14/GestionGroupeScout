<?php
echo $form->create(null, array('url' => array('controller' => 'modifier_fiche_med', 'action' => 'index', $id_enfant)));
?>

<h3><?php echo __('Antécédents médicaux', true); ?></h3>

<?php $form->input('Model.name', array('value' => 'whatever', 'type' => 'hidden'));
?>
<table>
        <tr><td>
                        <?php
                        if ($modification) {

                                foreach ($maladies as $valeur) {

                                        $tab[$valeur['Maladie']['id']] = $valeur['Maladie']['nom'];
                                }
                                foreach ($antecedents as $valeur) {
                                        echo $tab[$valeur];
                                        ?><br><?php
                }
        } else {
                $count = 0;
                $tab = array(0 => array(), 1 => array(), 2 => array());
                $tab1 = array(0 => array(), 1 => array(), 2 => array());

                foreach ($maladies as $valeur) {

                        $tab[$count % 3][$valeur['Maladie']['id']] = $valeur['Maladie']['nom'];

                        $count++;
                }

                echo $this->Form->input('antecedent1', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $tab[0], 'label' => false, 'selected' => $antecedents));
                                ?>
                        </td><td>
                                <?php echo $this->Form->input('antecedent2', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $tab[1], 'label' => false, 'selected' => $antecedents)); ?>
                        </td><td>
                                <?php
                                echo $this->Form->input('antecedent3', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $tab[2], 'label' => false, 'selected' => $antecedents));
                        }
                        ?>

                </td>
        </tr>
</table>
</br> 

<h3>
        <?php echo __('Questions générales sur votre jeune', true); ?></h3>

<table>
        <tr>
                <th>

                </th>
                <th>
                        <?php
//$question = array();
                        echo $form->label('oui', __('Oui', true)) . $form->label('non', __('Non', true));
                        ?>
                </th>
        </tr>
        <?php
        $tab = array();
        foreach ($questions as $value) {
                $tab[] = $value['QuestionGenerale']['texte'];
                ?>
                <tr>
                        <td>   
                                <?php echo $value['QuestionGenerale']['texte'] ?>
                        </td>
                        <td> 
                                <?php
                                echo $form->radio('q' . $value['QuestionGenerale']['id'], array('O' => '', 'N' => ''), array('label' => false,
                                    'legend' => false,
                                    'disabled' => $modification,
                                    'default' => $reponseQuestion[$value['QuestionGenerale']['id']]
                                        )
                                );
                                ?>
                        </td>
                </tr>
                <?php
        }
        ?>
</table>
<table>
        <tr>
                <td>
                        <h3><?php echo __('Médicament(s) autorisé(s)', true); ?></h3>
                </td>
                <td>
                        <h3><?php echo __('Médicament(s) sous prescription avec posologie ', true); ?></h3>
                </td>
        </tr>
        <?php
        $tab = array();
        foreach ($medicaments as $valeur) {
                $tab[$valeur['Medicament']['id']] = $valeur['Medicament']['nom'];
        }
        ?>	
        <tr>
                <td>

                        <?php
                        if ($modification) {
                                foreach ($resultmedicaments as $valeur) {
                                        echo $tab[$valeur];
                                        ?><br><?php
                }
        } else {
                echo $this->Form->input('medicamentautoriseLab', array('READONLY' => $modification, 'type' => 'select',
                    'multiple' => 'checkbox', 'options' => $tab, 'label' => ' ', 'selected' => $resultmedicaments));
        }
                        ?>

                </td>
                <td>
                        <?php echo $form->input('prescription', array('READONLY' => $modification, 'type' => 'textarea', true, 'label' => false, 'value' => $prescriptions)); ?>
                </td>
        </tr>
        <tr>
                <td>
                        <h3><?php echo __('Allergie(s)', true); ?></h3> 
                        <?php echo $form->input('allergie', array('READONLY' => $modification, 'type' => 'textarea', true, 'label' => false, 'value' => $allergies)); ?> 
                </td>
        </tr>
        <tr>
                <td>
                        <h3><?php echo __('Peur(s) et phobie(s)', true); ?> </h3>
                        <?php echo $form->input('peur', array('READONLY' => $modification, 'type' => 'textarea', true, 'label' => false, 'value' => $peurs)); ?>
                </td>
        </tr>
        <tr>
                <td colspan="2">
                        <div style="text-align:right;padding-top:20px"> 

                                <?php
                                echo $form->button(__('Annuler', true), array('type' => 'submit', 'name' => 'annuler'));
                                echo "&nbsp;&nbsp;&nbsp;";
                                if ($modification) {
                                        echo $form->button(__('Modifier', true), array('type' => 'submit', 'name' => 'modifier'));
                                } else {
                                        echo $form->button(__('Enregistrer', true), array('type' => 'submit', 'name' => 'enregistrer'));
                                }
                                echo $form->end();
                                ?>
                        </div>
                </td>
        </tr>
</table>
