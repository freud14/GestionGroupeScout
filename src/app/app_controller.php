<?php
class AppController extends Controller {
	var $helpers = array('Html', 'Javascript', 'Form');  
	
	function beforeFilter()
	{
		parent::beforeFilter();
		
		$resultat = $this->Session -> read('autentification.id_compte');
		if(empty($resultat)&&($this-> params['url']['url'] != 'Connexion'))
		{
			pr("redirigier");
			$this->redirect(array('controller'=>'Connexion', 'action'=>'index'));
		}
	}
}
?>
