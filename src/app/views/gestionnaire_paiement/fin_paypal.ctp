<?php
/**
 * Cette vue indique que le paiement Paypal a été effectué.
 * @author Frédérik Paradis
 */
?>
Votre paiement Paypal a bien été effectué. Un administrateur vérifiera votre paiement le plus tôt possible.
<?php echo $this->Html->link('Retourner au gestionnaire des paiements?', array('controller' => 'gestionnaire_paiement', 'action' => 'index')); ?>