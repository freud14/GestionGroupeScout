<?php

class RapportJeuneController extends AppController {

	var $name = 'RapportJeune';
	var $components = array('RequestHandler');

	function index() {
		Configure::write('debug', 0);
		$this->RequestHandler->respondAs('text/csv');
		$this->RequestHandler->setContent('csv', 'text/csv');

		$this->loadModel('Inscription');
		$this->set('inscriptions', $this->Inscription->find('all', array('recursive' => 3, 'conditions' => array('Annee.date_fin' => null, 'Inscription.date_fin' => null))));
	}

}

?>