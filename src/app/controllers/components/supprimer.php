<?php

class SupprimerComponent extends Object {
        /**
         *Permet de supprimer les informations de l'enfant dans la variable 
         * session
         * @param type Le formulaire qui l'appel 
         */
        function supprimerInscription($formulaire) {

                $formulaire->Session->write('info_gen', null);
                $formulaire->Session->write('fiche_med', null);
        }

}
?>

