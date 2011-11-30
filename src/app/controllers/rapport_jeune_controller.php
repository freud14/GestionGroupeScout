<?php

/**
 * Cette classe permet de générer un CSV avec la liste
 * des jeunes et de leur parent.
 * @author Frédérik Paradis
 */
class RapportJeuneController extends AppController {

	/**
	 * Le nom du contrôleur
	 * @var string
	 */
	var $name = 'RapportJeune';
	
	/**
	 * Les composants utilisés par le contrôleur.
	 * @var array
	 */
	var $components = array('RequestHandler');

	function liste() {
		if ($this->_getAutorisation() < 4) {
			$this->redirect(array("controller" => "accueil", "action" => "index"));
		}
		else {
			//Permet de voir si le CSV fonctionne même en debug.
			Configure::write('debug', 0);
			
			//Indique dans la requête HTTP qu'il s'agit d'un CSV.
			$this->RequestHandler->respondAs('text/csv');
			$this->RequestHandler->setContent('csv', 'text/csv');

			//On va chercher toutes les inscriptions
			$this->loadModel('Inscription');
			$this->set('inscriptions', $this->Inscription->find('all', array('recursive' => 3, 'conditions' => array('Annee.date_fin' => null, 'Inscription.date_fin' => null))));
		}
	}

}

?>