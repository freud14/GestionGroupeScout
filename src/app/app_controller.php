<?php
class AppController extends Controller {
	var $helpers = array('Html', 'Javascript', 'Form');  
	
	function beforeFilter()
	{
		parent::beforeFilter();
		
		$resultat = $this->Session -> read('authentification.id_compte');
		
		pr($this-> params['url']);
		if(empty($resultat)&&($this-> params['url']['url'] != 'connexion'))
		{
			pr("jaime les courges");
			//pr("redirigier");
			$this->redirect(array('controller'=>'connexion', 'action'=>'index'));
		}
	}
}
?>
