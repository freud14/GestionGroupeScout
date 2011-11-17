<?php
//App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class InscriptionFicheMedController extends AppController {

		 var $helpers = array('Html', 'Javascript', 'Form');  
		 var $name = 'InscriptionFicheMed';
		// var $components = array(array('Recaptcha.Captcha' => array(
          //      'private_key' => '6Ldq4MkSAAAAACIFrlwaf209zjAOhktImcx_FjlS', 
            //    'public_key' => '6Ldq4MkSAAAAABiDfADZgxzR3Nn_wB4qppT9QBKy'))); 

		function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'parent';
			$this->loadModel("Maladie");
			$this->loadModel('QuestionGenerale');
			$this->loadModel('Medicament');
		}

		public function getMaladieListe()
		{
			return $this->Maladie->find('all');
		}
	
		public function getQuestionListe()
		{
			return $this->QuestionGenerale->find('all');
		}
		public function getMedicamentListe()
		{
			return $this->Medicament->find('all');
		}
		/**
		 * view method
		 *
		 * @param string $id
		 * @return void
		 */
		 public function navigation() {
		
			
 			
			 $urlProvenance = $this -> Session -> read('url');
			 $this -> Session -> write("url", $this->params['url']);
			 
			if ( array_key_exists ('precedent',$this->params['form']))
 			{
 			//si le bouton précédent est cliqué
 				
 				$this->redirect(array('controller'=>'information_generale', 'action'=>'index'));
 			//pr($this->params['form']); 
 			}elseif( array_key_exists ('suivant',$this->params['form']))
 			{
 			//si le bouton suivant est cliqué	
 				$this->redirect(array('controller'=>'inscription_autorisation', 'action'=>'index'));
 			
 			}
 	
		}
		function validerConnexion()
		{
			
			
						
		}
		public function index() {
		//	$this -> validerConnexion();
			
			if (empty($this->data)) 
			{//Si ce n'est pas la page qui renvoit vers elle même
			
			$session = $this -> Session -> read('fiche_med.InscriptionFicheMed');
				if (!empty($session)) 
				{
			//s'il n'y a pas d'information déjà existante
					$session = array('antecedent1' => array() , 
    							'antecedent2' => array() , 
   							'antecedent3' => array() , 
    							'q1' => "" , 
    							'q2' => "" , 
    							'medicamentautoriseLab' => array() , 
    							'prescription' => "" , 
    							'allergie' => "" , 
    							'peur' => ""
    							) ;
				}
			}else{
			//c'est la page elle même qui s'apelle
    				$this -> Session -> write("fiche_med", $this->params['data']);
    				$this -> Session -> write("url", $this->params['url']);
    				$this->navigation();
    				$session = $this -> Session -> read('fiche_med.InscriptionFicheMed');
				
			}
			
 			// si on revient sur la page avec des informations déjà enregistrée
 			
 			
 			$antecedent = array();
 			$medicaments = array();
 			$buffer = array_merge((array)$session['antecedent1'], (array)$session['antecedent2'],(array)$session['antecedent3']);
 
  			if(!empty($buffer)){
  				foreach($buffer as $valeur){
 					$antecedent[] = $valeur;
 				}
 			}
 			if(!empty($session['medicamentautoriseLab']))
 			{
 				foreach($session['medicamentautoriseLab'] as $valeur)
 				{
 						$medicaments[] = $valeur;
 				}
 			}
 			
 			
 		$this->set('antecedents',$antecedent);
 		$this->set('resultmedicaments',$medicaments);
 		$this->set('peurs',$session['peur']);
 		$this->set('allergies',$session['allergie']);
 		$this->set('prescriptions',$session['prescription']);
 		
 		
 		
		$this->set('title_for_layout', __('Inscription d\'un enfant', true));
		$this->set('titre',__('Fiche médicale',true));
		$this->set('ariane', __('Informations générales > <span style="color: green;">Fiches médicales</span> > Autorisations', true));
		
		
		$this->set('maladies', $this->getMaladieListe());
		
		$this->set('questions', $this->getQuestionListe());
		
		$this->set('medicaments', $this->getMedicamentListe());
		
		
		
	}
}
?>
