<?php

/**
 * Cette classe de contrôleur pour l'élément 
 * de la gestion des paiements.
 */
class RepartitionController extends AppController {

	/**
	 * Le nom du contrôleur
	 * @var type string
	 */
	var $name = 'Repartition';

	/**
	 * Cette méthode récupère les différentes données à envoyer 
	 * à l'élément.
	 * @return type Retourne les différentes données à envoyer 
	 * à l'élément.
	 */
	function index() {
		$this->loadModel("Versement");
		$repartition['montants_versement'] = $this->Versement->find('all', array('conditions' => 'Versement.date IS NOT NULL', 'fields' => 'DISTINCT Versement.date', 'order' => 'Versement.date'));
		$repartition['frateries'] = $this->Versement->find('all', array('order' => array('Fraterie.position', 'Versement.position')));
		return $repartition;
	}

}

?>
