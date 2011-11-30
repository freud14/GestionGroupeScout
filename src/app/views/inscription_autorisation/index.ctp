<?php

echo $form->create(null);
echo $form->label('champsobligatoires', __('Les champs suivis d\'une étoile (*) sont obligatoires', true));
echo '<h3>' . __('Autorisation des baignades', true) . '</h3>';
$tab = array();
$tab[] = 'Moi, '. '<strong>' . $parent . '</strong>' . ', accepte que '. '<strong>' . $this->Session->read('info_gen.InformationGenerale.prenom') . '</strong>'.' se baigne sous la surveillance des animateurs du 102e Groupe scout des Laurentildes.';
echo $this->Form->input('autorisation_baignade', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $tab, 'label' => ' '));
$tab = array();
echo '<br><h3>' . __('Autorisation de photos', true) . '</h3>';
$tab[] = 'Moi, '. '<strong>' . $parent .  '</strong>' .', accepte que 102e Groupe scout des Laurentildes et le District de Québec publient des photos anonymes de  ' .  '<strong>' . $this->Session->read('info_gen.InformationGenerale.prenom') . '</strong>' .' dans le but de faire la promotion du scoutisme.';
echo $this->Form->input('autorisation_photo', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $tab, 'label' => ' '));
echo '<br>' . $form->label('avetissement1', __('Prenez note que ces autorisations sont valides pour la durée totale de
	l\'inscription c\'est-à-dire jusqu\'à la fin de l\'année scout et qu\'il n\'est pas possible de les retirer.', true));
?> 
<br>
<?php __('En cliquant sur le bouton « Accepter et valider l\'inscription » d\'un jeune au mouvement
	scout implique scout implique certaines responsabilités pour le parent. Vous comprenez également que vous aurez à participer à certains financements, à fournir du transport 
	à l\'occasion et à participer à des réunions de parents au cours de l\'année.', true);
?>
<br>
<?php
echo '<h3>' . __('Entrez votre mot de passe', true) . '</h3>';
echo $form->password('motdepassestr');
if (isset($erreurMDP)) {
	echo $erreurMDP;
}
echo '<br/>' . '<div>';
echo $form->button('Annuler l\'inscription', array('type' => 'submit', 'name' => 'annuler'));
echo $form->button('Étape précédente', array('type' => 'submit', 'name' => 'precedent'));
echo $form->button('Accepter et valider l\'inscription', array('type' => 'submit', 'name' => 'accepter'));
echo $form->end();
echo '</div>';
?>