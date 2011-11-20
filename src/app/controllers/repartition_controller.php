<?php

class RepartitionController extends AppController {

	var $name = 'Repartition';

	function index() {
		$this->loadModel("Versement");
		$repartition['montants_versement'] = $this->Versement->find('all', array('conditions' => 'Versement.date IS NOT NULL', 'fields' => 'DISTINCT Versement.date', 'order' => 'Versement.date'));
		$repartition['frateries'] = $this->Versement->find('all', array('order' => array('Fraterie.position', 'Versement.position')));
		return $repartition;
	}

}

?>
