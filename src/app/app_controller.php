<?php
class AppController extends Controller {
	var $helpers = array('Html', 'Javascript', 'Form', 'Session');  
	var $components = array('Session');  
	
	function beforeFilter()
	{
		parent::beforeFilter();
		
		$resultat = $this->Session -> read('authentification.id_compte');
		
		if(empty($resultat)&&($this-> params['url']['url'] != 'connexion'))
		{
			pr("jaime les courges");
			$this->redirect(array('controller'=>'connexion', 'action'=>'index'));
		}
	}
}
?>
