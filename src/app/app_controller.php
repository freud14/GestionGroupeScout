<?php
class AppController extends Controller {
	var $helpers = array('Html', 'Javascript', 'Form');  
	
	function beforeFilter()
	{
		parent::beforeFilter();
		
		$resultat = $this->Session -> read('authentification.id_compte');
		
		if(empty($resultat)&&($this-> params['url']['url'] != 'connexion'))
		{
			//$this->redirect(array('controller'=>'connexion', 'action'=>'index'));
		}
	}
}
?>
