<?php

class SupprimerComponent extends Object {
        /**
         *Permet de supprimer les informations de l'enfant dans la variable 
         * session
         * @param type Le formulaire qui l'appel 
         */
        function supprimerInscription($formulaire) {
		pr($formulaire);
		//  $formulaire->Session->delete('info_gen');
               // $formulaire->Session->delete('fiche_med');
        }

}
?>

