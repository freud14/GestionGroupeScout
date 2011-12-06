<?php

/**
 * Cette classe permet de créer la base de données
 * et d'y insérer les tables du système selon ce que 
 * l'utilisateur a entré dans le formulaire.
 * @author Frédérik Paradis
 */
class InstallationController extends AppController {

    /**
     * Les helpers utilisés par la vue.
     * @var type 
     */
    var $helpers = array('Html', 'Form');
    
    /**
     * Le nom du contrôleur.
     * @var string
     */
    var $name = 'Installation';

    /**
     * Cette méthode permet de configurer et d'installer
     * la base de données du système.
     * @author Frédérik Paradis
     */
    function index() {
        $this->set('title_for_layout', __('Installation', true));
        $this->set('titre', __('Installation', true));
        $this->set('ariane', __('Installation', true));
        $this->layout = 'aucun_menu';
        
        //Si l'installation a déjà été faite, on redirige l'utilisateur vers la page d'accueil.
        if($this->_isInstallationEffecutee()) {
            $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
        }

        //L'erreur à afficher dans la page.
        $erreur = '';

        if (!empty($this->data)) {
            //On essaye de se connecter au serveur de BD fourni par l'utilisateur
            $connexion = @mysql_connect($this->data['Installation']['serveur'], 
                    $this->data['Installation']['utilisateur'], 
                    $this->data['Installation']['mot_de_passe']);

            if ($connexion === false) {
                $erreur = __('Impossible de se connecter au serveur de base de données.', true);
            } else {
                $bd = $this->data['Installation']['bd'];
                $succes = true;

                //On regarde si l'utilisateur veut qu'on crée la BD.
                if ($this->data['Installation']['creerBD'] == '1') {
                    $bd = str_replace("`", "", $bd);
                    $succes = @mysql_query("CREATE DATABASE `" . $bd . "`;", $connexion);
                    if ($succes === false) {
                        $erreur = __('Impossible de créer la base de données.', true);
                    }
                }

                //On essaye de se connecter à la base de données
                if ($succes === true) {
                    $succes = @mysql_select_db($bd, $connexion);
                    if ($succes === false) {
                        $erreur = __('Impossible d\'ouvrir la base de données.', true);
                    }
                }

                if ($succes === true) {
                    
                    //On regarde si l'utilisateur veut installer la démo ou pas.
                    $fichier = 'scout102vide.sql';
                    if ($this->data['Installation']['demo'] != '0') {
                        $fichier = 'scout102demo.sql';
                    }
                    
                    //On prend chacune des requêtes SQL individuellement
                    $create = explode(';', file_get_contents($fichier, true));
                    
                    //Et on les exécute.
                    foreach ($create as $query) {
                        if (trim($query) != '') {
                            $succes = @mysql_query($query, $connexion);
                            if (!$succes) {
                                $erreur = __('Impossible de créer toutes les tables.', true);
                                break;
                            }
                        }
                    }
                    
                    //Si tout a été réussi, on crée le fichier de configuration
                    if ($succes) {
                        $databaseFichier = file_get_contents('installation_database.txt', true);
                        $databaseFichier = sprintf($databaseFichier,
                                addslashes($this->data['Installation']['serveur']), 
                                addslashes($this->data['Installation']['utilisateur']), 
                                addslashes($this->data['Installation']['mot_de_passe']), 
                                addslashes($bd));
                        
                        //On sauvegarde le fichier d'installation database.php.
                        copy("../config/database.php", "../config/database.install.php");
                        
                        //On écrit le nouveau fichier de configuration.
                        file_put_contents("../config/database.php", $databaseFichier, FILE_USE_INCLUDE_PATH);
                        
                        @mysql_close($connexion);
                        
                        //On redirige l'utilisateur vers la page pour créer le pilote du système.
                        $this->redirect(array('controller' => 'inscrire_adulte', 'action' => 'installation'));
                    }
                }

                //On ferme la connexion précédemment ouverte.
                @mysql_close($connexion);
            }
        }

        $this->set('erreur', $erreur);
    }

}

?>
