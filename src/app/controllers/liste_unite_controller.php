<?php

//App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class ListeUniteController extends AppController {

        var $helpers = array('Html', 'Form');
        var $name = 'ListeUnite';

        function beforeFilter() {
                parent::beforeFilter();
                $this->layout = 'admin';
                $this->loadModel('Unite');
                $this->loadModel('Inscription');
                $this->loadModel('Adulte');
                $this->loadModel('AdultesUnite');
                $this->loadModel('AutorisationsCompte');
                $this->loadModel('Compte');
                $this->loadModel('Annee');
                $this->loadModel('Autorisation');
        }

        /**
         * Affiche l'ensemble des enfants selon leur unité.
         * On peut changer l'affichage pour voir un tableau d'unité spécifique
         * @todo  faire l'exportation excel
         */
        public function index() {


                $this->set('titre', 'Liste des unités');
                $this->set('ariane', __('<span style="color: green;">Liste </span> > Liste des unités', true));
                $this->set('title_for_layout', __('Liste des unités', true));
                $nomUnite = $this->_listeOption('Tous', 'option');
                //Si une valeure autre que tous a été choisie
                if ((!empty($this->data['ListeUnite'])) && ($this->data['ListeUnite']['Afficher'] != "0")) {

                        $unite = $this->Unite->find('all', array('recursive' => 2,
                            'conditions' => array('Unite.Id' => $this->data['ListeUnite']['Afficher'], 'Unite.nom' => $nomUnite)));
                } else {

                        $unite = $this->Unite->find('all', array('recursive' => 2, 'conditions' => array('Unite.Nom ' => $nomUnite)));
                }

                $this->set('unite', $unite);
        }

        /**
         * Permet d'assigner les jeunes à leur unité 
         * @todo  faire l'exportation excel
         */
        public function assigner() {
                if ($this->_getAutorisation() <= 2) {
                        $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
                }
                $this->set('titre', 'Assigner des jeunes dans une unité');
                $this->set('ariane', __('<span style="color: green;">Gestion des unités </span> > Assigner un jeune', true));
                $this->set('title_for_layout', __('Assigner un jeune', true));



                //Action spécifique selon le bouton
                if (array_key_exists('assigner', $this->params['form'])) {

                        $this->_assignerEnfant();
                } elseif (array_key_exists('retirer', $this->params['form'])) {
                        $this->_retirerEnfant();
                } elseif (array_key_exists('voir', $this->params['form'])) {
                        $this->_voirAssigner();
                }
                $this->_voirAssigner();
        }

        public function assigner_animateur() {
                if ($this->_getAutorisation() <= 2) {
                        $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
                }
                $this->set('titre', 'Assigner des animateurs dans une unité');
                $this->set('ariane', __('<span style="color: green;">Gestion des unités </span> > Assigner un jeune', true));
                $this->set('title_for_layout', __('Assigner un animateur', true));

                //Option pour la liste déroulante 
                $nomUnite = $this->_listeOption('Animateurs non assignés', 'option');
                $this->_listeOption(null, 'optionAssignation');



              
                //$adulte_unite = $this->AdultesUnite->find('all', array('recursive' =>2));



                $tabUnite = $this->Unite->find('all', array('recursive' => 2));
                // pr($tabUnite);
                $listeUnite = array();

                foreach ($tabUnite as $value) {
                       
                        $animateur = array();
                        foreach ($value['Adulte'] as $adulteValeur) {
                                $animateur[$adulteValeur['id']] = $adulteValeur['prenom'] . " " . $adulteValeur['nom'];
                        }
                        $listeUnite[$value['Unite']['id']] = array('nom' => $value['Unite']['nom'],'adulte' => $animateur);
                }
                pr($listeUnite);
                $tabAnimateur = $this->Autorisation->find('all',array('recursive' => 2));
                pr($tabAnimateur);
                $compte = array();
                $adulte = array();
                $animateurAss = array();
                $animateurNonAss = array();
                //pr($autorisation);
                foreach ($autorisation as $value) {
                        $compte[] = $this->Compte->find('all', array('recursive' => 2, 'conditions' => array('id' => $value['AutorisationsCompte']['compte_id'])));
                }
                $mesAdultes = array();
                //pr($compte);
                foreach ($compte as $value) {
                        $mesAdultes[$value[0]['Adulte'][0]['id']] = array('nom' => $value[0]['Adulte'][0]['prenom'] . " " . $value[0]['Adulte'][0]['nom']);
                        $adulte = $value;
                }

                //pr($mesAdultes);

                foreach ($adulte_unite as $uni) {
                        foreach ($adulte['Adulte'] as $adl) {
                                //
                                //  pr($adl);
                                if ($uni['AdultesUnite']['adulte_id'] == $adl['id']) {
                                        $animateurAss[$adl['id']] = array('nom' => $adl['prenom'] . ' ' . $adl['nom'],
                                            'unite_id' => $uni['AdultesUnite']['unite_id']);
                                } else {
                                        $animateurNonAss[$adl['id']] = array('nom' => $adl['prenom'] . ' ' . $adl['nom'],
                                            'unite_id' => null);
                                }
                        }
                }

                //pr($animateurNonAss);

                if ((!empty($this->data['Animateur'])) && ($this->data['Animateur']['Afficher'] != "0")) {
                        
                } else {
                        
                }



                $this->set('titreUnite', $titreUnite);
                $this->_initEnfant($unite);
        }

        private function _voirAssigner() {

                //Option pour la liste déroulante 
                $nomUnite = $this->_listeOption('Jeunes non assignés', 'option');
                $this->_listeOption(null, 'optionAssignation');

                //Cherche l'année actuelle soit qui n'est pas finit donc pas de date de fin
                $annee = $this->Annee->find('first', array('conditions' => array('Annee.date_fin' => null)));
                //Si les jeunes non assignés ne sont pas sélectionner affiche les bons enfants dans les bonnes unités
                if ((!empty($this->data['Assigner'])) && ($this->data['Assigner']['Afficher'] != "0")) {

                        $unite = $this->Inscription->find('all', array('recursive' => 2,
                            'conditions' => array('Inscription.unite_id' => $this->data['Assigner']['Afficher'],
                                'Inscription.annee_id' => $annee['Annee']['id'])));
                        $titreUnite = $nomUnite[$this->data['Assigner']['Afficher']];
                } else {

                        $unite = $this->Inscription->find('all', array('conditions' => array('Inscription.unite_id' => null,
                                'Inscription.annee_id' => $annee['Annee']['id'])));

                        $titreUnite = 'Jeune non assignés';
                }

                $this->set('titreUnite', $titreUnite);
                $this->_initEnfant($unite);
        }

        /**
         * Enregistrement de membre
         * @return void
         */
        private function _initEnfant($requete) {
                $enfant = array();
                foreach ($requete as $value) {
                        $enfant[$value['Enfant']['id']] = array('nom' => $value['Enfant']['prenom'] . ' ' . $value['Enfant']['nom'],
                            'sexe' => $value['Enfant']['sexe'],
                            'naissance' => $value['Enfant']['date_naissance'],
                            'groupe' => $value['GroupeAge']['nom'] . "( " .
                            $value['GroupeAge']['age_min'] . " - "
                            . $value['GroupeAge']['age_max'] . ")"
                        );
                }

                $this->set('enfant', $enfant);
        }

        /**
         * Retourne l'id de l'autorisation la importante du compte pilote>administrateur>consultation>animateur
         */
        private function _getAutorisation() {
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

        /**
         * Donne la liste des noms que le membre peut voir
         * @param $option1  le nom du premier champ de la liste déroulante
         * @return la liste des noms des unités que le membre peut voir selon ses droits d'accès
         * @author Michel Biron et Luc-Frédéric Langis
         */
        private function _listeOption($option1, $nomVar) {

                $autorisation = $this->_getAutorisation();
                $droplist = array();
                $option = array();
                if (isset($option1)) {
                        $option[] = $option1;
                }
                //s'il n'a pas d'autorisation (un parent) on le renvoit a laccueil
                if (empty($autorisation)) {
                        $this->redirect(array('controller' => 'accueil', 'action' => 'index'));
                }
                //si c'est un animateur on affiche juste les unites auquel il est assigné
                elseif ($autorisation == 1) {
                        $unite = $this->Compte->find('all', array('recursive' => 2,
                            'conditions' => array(
                                'Compte.Id' => $this->Session->read('authentification.id_compte')))
                        );
                        $unite = $unite['0']['Adulte']['0']['Unite'];
                        foreach ($unite as $valeur) {
                                $option[$valeur['id']] = $valeur['nom'];
                        }
                }
                //s'il a les droits de consultations(ou plus) on affiche toutes les unités
                else {
                        $unite = $this->Unite->find('all');
                        foreach ($unite as $valeur) {
                                $option[$valeur['Unite']['id']] = $valeur['Unite']['nom'];
                        }
                }


                $this->set($nomVar, $option);
                return $option;
        }

        /**
         * Assigne un jeune à une nouvelle unité
         * @return void
         */
        private function _assignerEnfant() {


                $uniteAssigner = array();
                $enfantId = array();

                //Divise le $this->data puisque l'assignation ne peut être changer au niveau de l'index, on doit les séparer
                foreach ($this->data['Assigner'] as $cle => $inscription) {
                        if ($cle != 'assignation' && $cle != 'Afficher') {
                                $enfantId[$cle] = $inscription;
                        } else {
                                $uniteAssigner[$cle] = $inscription;
                        }
                }

                //Parcours le tableau diviser pour chacun des enfants
                foreach ($enfantId as $cle => $inscription) {
                        if (!empty($inscription)) {
                                $enfant = array();

                                //On recherche l'id de l'inscription relié à l'enfant
                                $enfant = $this->Inscription->find('first', array('conditions' => array('Inscription.enfant_id' => $cle)));

                                //Enregistrement de l'inscription à la nouvelle unité
                                $this->Inscription->save(array('id' => $enfant['Inscription']['id'],
                                    'unite_id' => $uniteAssigner['assignation']));
                        }
                }
        }

        /**
         * Assigne un jeune à une nouvelle unité
         * @return void
         */
        private function _retirerEnfant() {
                $enfantId = array();

                //Divise le $this->data puisque l'assignation ne peut être changer au niveau de l'index, on doit les séparer
                // Puisque les enfants sont retirer, on ne prend pas l'unité sélectionner par défaut dans le $this->data
                foreach ($this->data['Assigner'] as $cle => $inscription) {
                        if ($cle != 'assignation' && $cle != 'Afficher') {
                                $enfantId[$cle] = $inscription;
                        }
                }

                //Parcours le tableau diviser pour chacun des enfants
                foreach ($enfantId as $cle => $inscription) {
                        if (!empty($inscription)) {
                                $enfant = array();

                                //On recherche l'id de l'inscription relié à l'enfant
                                $enfant = $this->Inscription->find('first', array('conditions' => array('Inscription.enfant_id' => $cle)));

                                //Enregistrement de l'inscription à la nouvelle unité
                                $this->Inscription->save(array('id' => $enfant['Inscription']['id'],
                                    'unite_id' => null));
                        }
                }
        }

}

?>
