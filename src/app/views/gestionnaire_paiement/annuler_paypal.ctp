<?php
/**
 * Cette vue indique que le paiement Paypal a été annulé.
 * @author Frédérik Paradis
 */
?>
Votre paiement Paypal a bien été annulé. Vous pouvez maintenant choisir un autre mode de paiement.
<?php echo $this->Html->link('Retourner au gestionnaire des paiements?', array('controller' => 'gestionnaire_paiement', 'action' => 'index')); ?>