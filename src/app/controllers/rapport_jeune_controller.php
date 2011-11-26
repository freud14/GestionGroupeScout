<?php

class RapportJeuneController extends AppController {

	var $name = 'RapportJeune';
	var $components = array('RequestHandler');

	function liste() {
		if ($this->_getAutorisation() < 4) {
			$this->redirect(array("controller" => "accueil", "action" => "index"));
		}
		else {
			Configure::write('debug', 0);
			$this->RequestHandler->respondAs('text/csv');
			$this->RequestHandler->setContent('csv', 'text/csv');

			$this->loadModel('Inscription');
			$this->set('inscriptions', $this->Inscription->find('all', array('recursive' => 3, 'conditions' => array('Annee.date_fin' => null, 'Inscription.date_fin' => null))));
		}
	}

}

?>