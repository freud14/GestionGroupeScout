<?php

class AppController extends Controller {

        var $helpers = array('Html', 'Javascript', 'Form', 'Session');
        var $components = array('Session');

        function beforeFilter() {
                parent::beforeFilter();
                setlocale(LC_ALL, SET_LOCALE_ACTUEL, SET_LOCALE_ACTUEL_WINDOWS);
                $this->Session->write("url", $this->params['url']);
                $resultat = $this->Session->read('authentification.id_compte');
                $pageNonConnecte = array('connexion', 'inscrire_adulte', 'installation');
                if (empty($resultat) && !in_array($this->params['controller'], $pageNonConnecte)) {

                        $this->redirect(array('controller' => 'connexion', 'action' => 'index'));
                }
        }

        /**
         * Retourne l'id de l'autorisation la importante du compte pilote>administrateur>consultation>animateur
         */
        protected function _getAutorisation() {
                $accesNum = 0;
                $autorisation = $this->Session->read('authentification.autorisation');
                if (!empty($autorisation)) {
                        foreach ($autorisation as $valeur) {
                                if ($valeur['id'] > $accesNum) {
                                        $accesNum = $valeur['id'];
                                }
                        }
                }
                return $accesNum;
        }

    
}

?>
