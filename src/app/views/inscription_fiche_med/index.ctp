<?php
/* if (isset($_POST["nomboutont"]){

  } */

echo $form->create(null);
?>

<h3><?php echo __('Antécédents médicaux', true); ?></h3>
<?php
$count = 0;
$tab = array(0 => array(), 1 => array(), 2 => array());
$tab1 = array(0 => array(), 1 => array(), 2 => array());

foreach ($maladies as $valeur) {

        $tab[$count % 3][$valeur['Maladie']['id']] = $valeur['Maladie']['nom'];

        $count++;
}
?>
<table>
        <tr><td>
<?php
//echo $form->input('Model.name', array('multiple' => 'checkbox', 'options' => $options, 'selected' => $selected));
echo $this->Form->input('antecedent1', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $tab[0], 'label' => false, 'selected' => $antecedents));
?>
                </td><td>
                        <?php echo $this->Form->input('antecedent2', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $tab[1], 'label' => false, 'selected' => $antecedents)); ?>
                </td><td>
                        <?php
                        echo $this->Form->input('antecedent3', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $tab[2], 'label' => false, 'selected' => $antecedents));
                        ?>

                </td></tr></table></br> 

<h3>
<?php echo __('Questions générales sur votre jeune', true); ?></h3>

<table><tr><th></th><th>
<?php
//$question = array();
echo $form->label('oui', __('Oui', true)) . $form->label('non', __('Non', true));
?>
                </th></tr>
                        <?php
                        //test
                        /* echo $form->input('describeJob', array('label' => false,'div' => false,'type' => 'select','multiple'=>'checkbox','legend' => 'false','options' =>
                          array('Physical' => 'Physical','Mental' => 'Mental', 'Stressful' => 'Stressful',  'Easy-going' => 'Easy-going',
                          'Secure' => 'Secure', 'Non-secure' => 'Non-secure', 'Exhausting' => 'Exhausting', 'Relaxing' => 'Relaxing' ),
                          )); */
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
                                echo $form->radio('q' . $value['QuestionGenerale']['id'], 
                                                  array('O' => '', 'N' => ''), 
                                                  array('label' => false,
                                                        'legend' => false,
                                                        'default' => $reponseQuestion[$value['QuestionGenerale']['id']]
                                            )
                                        );
                                ?>
                        </td>
                </tr>
                                <?php
                        }

                        /* RADIO BUTON
                          echo $form -> radio('questions',array('label' => false, 'legend' => false));
                          echo $this->Form->radio('antecedent23',
                          $tab,
                          array( 'legend' => false,'label' => false)); */
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

        <?php echo $this->Form->input('medicamentautoriseLab', array('type' => 'select',
            'multiple' => 'checkbox', 'options' => $tab, 'label' => ' ', 'selected' => $resultmedicaments)); ?>

                </td>
                <td>
                        <?php echo $form->input('prescription', array('type' => 'textarea', true, 'label' => false, 'value' => $prescriptions)); ?>
                </td>
        </tr>
        <tr>
                <td>
                        <h3><?php echo __('Allergie(s)', true); ?></h3> 
<?php echo $form->input('allergie', array('type' => 'textarea', true, 'label' => false, 'value' => $allergies)); ?> 
                </td>
        </tr>
        <tr>
                <td>
                        <h3><?php echo __('Peur(s) et phobie(s)', true); ?> </h3>
<?php echo $form->input('peur', array('type' => 'textarea', true, 'label' => false, 'value' => $peurs)); ?>
                </td>
        </tr>
</table>
                        <?php
                        echo $form->button('Étape précédente', array('type' => 'submit', 'name' => 'precedent'));
                        echo $form->button('Étape suivante', array('type' => 'submit', 'name' => 'suivant'));

                        echo $form->end();
                        ?>
