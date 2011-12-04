<?php

class InstallationController extends AppController {

    var $helpers = array('Html', 'Form');
    var $name = 'Installation';

    function index() {
        $this->layout = 'blank';
        $erreur = '';

        if (!empty($this->data)) {
            $connexion = @mysql_connect($this->data['Installation']['serveur'], $this->data['Installation']['utilisateur'], $this->data['Installation']['mot_de_passe']);

            if ($connexion === false) {
                $erreur = __('Impossible de se connecter au serveur de base de données.', true);
            } else {
                $bd = $this->data['Installation']['bd'];
                $succes = true;

                if ($this->data['Installation']['creerBD'] == '1') {
                    $bd = str_replace("`", "", $bd);
                    $succes = @mysql_query("CREATE DATABASE `" . $bd . "`;", $connexion);
                    if ($succes === false) {
                        $erreur = __('Impossible de créer la base de données.', true);
                    }
                }

                if ($succes === true) {
                    $succes = @mysql_select_db($bd, $connexion);
                    if ($succes === false) {
                        $erreur = __('Impossible d\'ouvrir à la base de données.', true);
                    }
                }

                if ($succes === true) {
                    $create = explode(';', file_get_contents('scout102.sql', true));
                    foreach ($create as $query) {
                        $succes = @mysql_query($query, $connexion);
                        if (!$succes) {
                            $erreur = __('Impossible de créer toutes les tables.', true);
                            break;
                        }
                    }
                    if ($succes) {
                        $databaseFichier = file_get_contents("commentaire_cake.txt", true);
                        $databaseFichier = sprintf($databaseFichier, addslashes($this->data['Installation']['serveur']), addslashes($this->data['Installation']['utilisateur']), addslashes($this->data['Installation']['mot_de_passe']), addslashes($bd));
                        copy("../config/database.php", "../config/database.install.php");
                        file_put_contents("../config/database.php", $databaseFichier, FILE_USE_INCLUDE_PATH);
                        @mysql_close($connexion);
                    }
                }

                @mysql_close($connexion);
            }
        }

        $this->set('erreur', $erreur);
    }

}

?>
