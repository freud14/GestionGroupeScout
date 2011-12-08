<?php
$accesNum = 0;
$autorisation = $this->Session->read('authentification.autorisation');
if (!empty($autorisation)) {
    foreach ($autorisation as $valeur) {
        if ($valeur['id'] > $accesNum) {
            $accesNum = $valeur['id'];
        }
    }
}
?>
<div>
    <?php
    echo '<table border="0">' .
    '<tr>' .
    '<td >';
    echo $form->create('ListeUnite', array('url' => array('controller' => 'ListeUnite', 'action' => 'Index')));


    echo $this->Form->input(__('Afficher', true), array('type' => 'select', 'options' => $option));

    echo '</td>' .
    '<td >';
    echo $this->Form->button(__('Voir', true), array('type' => 'summit'));
    echo $form->end();
    echo '</td>' .
    '<td >';
    if ($accesNum >= 4) {
        echo $form->create('', array('url' => array('controller' => 'rapport_jeune', 'action' => 'liste.csv')));
        echo $this->Form->button(__('Exporter sur excel...', true), array('type' => 'summit'));
        echo $form->end();
    }
    echo'</td>' .
    '</tr>' .
    '</table>';
    ?>

    <br><br>
    <div>

        <?php
        foreach ($unite as $value) {
            echo '<div>';
            if ($value['GroupeAge']['sexe'] == 1) {

                $sexe = 'Masculin';
            } else {
                $sexe = 'Feminin';
            }
            echo '<h3>' . $value['Unite']['nom'] . ' | ' . $value['GroupeAge']['age_min'] . '-' . $value['GroupeAge']['age_max'] . ' | Sexe : ' . $sexe . '</h3>';
            echo '<table border="1">' .
            '<th  style ="width:200px" >' .
            'Nom' .
            '</th>' .
            '<th  style ="width:120px">' .
            'Sexe' .
            '</th>' .
            '<th  style ="width:120px">' .
            'Âge' .
            '</th>';
            echo '<th>'.wordwrap(__('Informations générales', true), 20, '<br />').'</th>
            <th>'.wordwrap(__('Fiche médicale',true), 20, '<br />').'</th>';
            echo '</tr>';
            
            
            foreach ($value['Inscription'] as $inscription) {

                echo '<tr>' .
                '<td>';
                echo $inscription['Enfant']['prenom'] . ' ' . $inscription['Enfant']['nom'];

                echo '</td>' .
                '<td>';

                if ($inscription['Enfant']['sexe'] == 1) {
                    echo 'M';
                } else {
                    echo 'F';
                }

                echo '</td>' .
                '<td>';

                echo $inscription['Enfant']['date_naissance'];

                echo '</td>';
                
                echo '<td style="text-align:center; vertical-align: middle;">'.nl2br($this->Html->link(wordwrap(__('Informations générales', true), 20), array('controller' => 'modifier_information_generale', 'action' => 'index', $inscription['Enfant']['id']))).'</td>';
                echo '<td style="text-align:center; vertical-align: middle;">'.nl2br($this->Html->link(wordwrap(__('Fiche médicale', true), 20), array('controller' => 'modifier_fiche_med', 'action' => 'index', $inscription['Enfant']['id']))).'</td>';
                
                echo '</tr>';
            }


            echo'</table>';
            echo '</div>';
        }
        ?>

        <div>

            <br>

        </div>
