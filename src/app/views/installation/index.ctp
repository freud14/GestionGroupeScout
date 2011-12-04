<?php
/**
 * Cette vue permet d'afficher le formulaire permettant
 * de configurer et d'installer la base de données du
 * système.
 * @author Frédérik Paradis
 */
?>
<?php if ($erreur != '') { ?>
    <div style="color: red"><?php echo $erreur; ?></div>
<?php } ?>

<?php
echo $form->create(null);
?>

<?php
echo $form->input('bd', array(
    'label' => array(
        'text' => __('Nom de la base de données', true),
        'class' => 'element'),
    'after' => $form->checkbox('creerBD') . __('Créer la base de données?', true)));
?>

<?php
echo $form->input('serveur', array('default' => 'localhost', 'label' => array('text' => __('Adresse de la base de données (par défaut: localhost)', true), 'class' => 'element')));
?>

<?php
echo $form->input('utilisateur', array('label' => array('text' => __('Nom de l\'utilisateur de la base de données', true), 'class' => 'element')));
?>

<?php
echo $form->input('mot_de_passe', array('type' => 'password', 'label' => array('text' => __('Mot de passe de la base de données', true), 'class' => 'element')));
?>
<p style="clear: both;">
    <br />
    <?php
    echo $form->checkbox('demo') . __('Installation démo?', true);
    ?>
</p>
<div style="clear: both; text-align: right">
    <?php
    echo $form->end(__('Effectuer l\'installation', true));
    ?>
</div>
