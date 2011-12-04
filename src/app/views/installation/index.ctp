<style>
    label.element
    {
        width: 400px;
        display:inline-block;
        float:left;
        vertical-align:top;
        clear: both;
    }
    .input
    {
        clear: both;
    }
</style>


<?php if ($erreur != '') { ?>
    <div style="color: red"><?php echo $erreur; ?></div>
<?php } ?>

<?php
echo $form->create(null);

echo $form->input('bd', array(
    'label' => array(
        'text' => __('Nom de la base de données', true),
        'class' => 'element'),
    'after' => $form->checkbox('creerBD') . __('Créer la base de données?', true)));

echo $form->input('serveur', array('default' => 'localhost', 'label' => array('text' => __('Adresse de la base de données (par défaut: localhost)', true), 'class' => 'element')));

echo $form->input('utilisateur', array('label' => array('text' => __('Nom de l\'utilisateur de la base de données', true), 'class' => 'element')));

echo $form->input('mot_de_passe', array('type' => 'password', 'label' => array('text' => __('Mot de passe de la base de données', true), 'class' => 'element')));

echo $form->end(__('Effectuer l\'installation', true));
?>
