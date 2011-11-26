<?php

/**
 * Cette classe gère la gestion des paiements pour
 * les parents.
 */
class GestionnairePaiementController extends AppController {

    /**
     * Le nom du contrôleur
     * @var string
     */
    var $name = 'GestionnairePaiement';
    /**
     * Les différents Helpers utilisés par le contrôleur et la vue.
     * @var array
     */
    var $helpers = array("Html", 'Form');
    /**
     * Les composants utilisés par le contrôleur.
     * @var array
     */
    var $components = array('InformationPaiement', 'Email');

    /**
     * Cette méthode initialise le contrôleur.
     */
    function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'parent';
        $this->loadModel('Compte');
        $this->loadModel('Inscription');
        $this->loadModel('Annee');
        $this->loadModel('Facture');
	$this->loadModel('Unite');
        setlocale(LC_ALL, 'fr_CA.utf8');
        $this->set('title_for_layout', __('Gestionaire de paiements', true));
    }

    /**
     * Cette méthode sert à afficher le statut du paiement
     * d'un parent. Par défaut, les enfants du parent courrant
     * sont affichés. Si l'utilisateur actuel est un administrateur
     * et qu'un id est envoyé, les enfants du parent dont l'id
     * est envoyé sont affichés.
     * @param type $adulte_id L'id de l'adulte
     */
    function index($adulte_id = NULL) {
        if ($adulte_id == NULL) {
            $this->set('titre', __('Gestionaire de paiements', true));
            $this->set('ariane', __('Gestionaire de paiements', true));

            $adulte_id = $this->Session->read('authentification.id_adulte');
            $this->set('inscriptions', $this->GestionnairePaiement->getInscriptions($adulte_id));
        } else {
            $this->layout = 'admin';
            $this->set('title_for_layout', __('Gestion des paiements', true));
            $this->set('titre', __('Statut du paiement', true));
            $this->set('ariane', __('Gestion des paiements > Statut du paiement', true));

            $this->set('inscriptions', $this->GestionnairePaiement->getInscriptions($adulte_id));
            $this->set('admin', true);
            $this->set('id_adulte', $adulte_id);
        }
    }

    /**
     * Cette méthode sert à initialiser et à gérer le
     * paiement d'un membre. Par contre, elle ne permet pas
     * de spécifier la date de réception et de paiement
     * ce qui doit se faire par un administrateur.
     */
    function effectuer_paiement() {
        $this->set('titre', __('Effectuer un paiement', true));
        $this->set('ariane', __('Gestionaire de paiements > Effectuer un paiement', true));

        $adulte_id = $this->Session->read('authentification.id_adulte');

        if (!empty($this->data)) {
            $inscriptions = array();
            $keys = preg_grep("/^inscription([0-9]+)$/", array_keys($this->data['GestionnairePaiement']));
            foreach ($keys as $key) {
                if ($this->data['GestionnairePaiement'][$key] != 0) {
                    $inscriptions[] = $this->data['GestionnairePaiement'][$key];
                }
            }
            $this->InformationPaiement->créerPaiements($adulte_id, $inscriptions, $this->data['GestionnairePaiement']['mode']);

            //On redirige l'utilisateur vers le gestionnaire des paiements
            $this->redirect(array('controller' => 'gestionnaire_paiement', 'action' => 'index'));
        } else {
            $this->loadModel('PaiementInscription');
            $versements = $this->PaiementInscription->getTarifs();

            $nb_inscription_paye = $this->PaiementInscription->getNbInscriptionPayé($adulte_id);
            $inscriptions = $this->PaiementInscription->getInscriptionNonPayé($adulte_id);

            $this->set('versements', $versements);

            $this->set('nb_inscription_paye', $nb_inscription_paye);
            $this->set('inscriptions', $inscriptions);
        }
    }

    /* Cette fonction permet d'envoyer des recus d'impôt
     */

    public function courriel($id_compte, $imprimer) {

        $parent = $this->Compte->find('all', array('recursive' => 2, 'conditions' => array('Compte.id' => 1)));

        //Cherche l'année actuelle soit qui n'est pas finit donc pas de date de fin
        $annee = $this->Annee->find('first', array('conditions' => array('Annee.date_fin' => null)));

        //On va chercher les paiements, les informations des enfants, de l'adulte et etc.
        $inscription = array();
        foreach ($parent[0]['Adulte'][0]['Enfant'] as $value) {
            $inscription[$value['id']] = $this->Inscription->find('all', array('recursive' => 4, 'conditions' => array('enfant_id' => $value['id'], 'Inscription.annee_id' => $annee['Annee']['id'])));
        }


        $facture = array();
	$unite = array();
        foreach ($inscription as $cle=> $value) {
            $facture[$cle] = $this->Facture->find('all', array('recursive' => 2, 'conditions' => array('inscription_id' => $value[0]['Inscription'])));
	    $unite[$cle] = $this->Unite->find('all', array('conditions' => array('Unite.id' => $value[0]['Inscription']['unite_id'])));
        }



        $paiement = array();
        foreach ($facture as $value) {
            foreach ($value as $value2) {
                $paiement[] = 0;
                $len = count($paiement) - 1;
                foreach ($value2['Paiement'] as $value3) {
                    $paiement[$len] +=$value3['montant'];
                }
            }
        }

	pr($paiement);


            /* SMTP option */
    $this->Email->smtpOptions = array(
                'port'=>'465',
                'timeout'=>'30',
                'host' => 'ssl://smtp.gmail.com',
                'username'=>'102e.groupe@gmail.com',
                'password'=>'groupePS102',
                );


      
            $this->Email->from = '102e groupe des Laurentides ';
           // $this->Email->to = $parent[0]['Compte']['nom_utilisateur'];
            $this->Email->to = 'lucf.langis@gmail.com';
            $this->Email->bcc = array('lol.ca');
            $this->Email->subject = __('Reçut d\'impôt pour', true);
            $this->Email->template = 'recu_impot';
            $this->Email->sendAs = 'html';
            $this->set('parent', $parent);
            $this->set('inscription', $inscription);
	    $this->set('paiement', $paiement);
	    $this->set('unite', $unite);
            $this->Email->send();
            $this->Email->reset();
        
    }

}