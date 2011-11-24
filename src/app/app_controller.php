<?php
class AppController extends Controller {
	var $helpers = array('Html', 'Javascript', 'Form', 'Session');  
	var $components = array('Session');  
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this -> Session -> write("url", $this->params['url']);
		$resultat = $this->Session -> read('authentification.id_compte');
		//pr($this->params['url']); 
		if(empty($resultat)&&($this-> params['url']['url'] != 'connexion')&&($this -> params['url']['url'] != 'inscrire_adulte'))
		{
			
			$this->redirect(array('controller'=>'connexion', 'action'=>'index'));
		}
	}
	
}
?>
