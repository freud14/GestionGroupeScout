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
			$this->loadModel('Compte');
			$this->loadModel('Adulte');
			$this->loadModel('AdultesImplication');
			$this->loadModel('Implication');
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
		// pr($this->Session->read('fiche_med'));
			$this -> Session -> write("fiche_med", $this->params['data']);
 			$this -> Session -> write("url", $this->params['url']);
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
		
		public function index() {
			pr($this->Session->read('fiche_med.InscriptionFicheMed'));
			$session = $this -> Session -> read('fiche_med.InscriptionFicheMed');
			
			if (!empty($this->data)) {
			// Si c'est la page qui c'est rappeler elle meme avec de l'information
				$this->navigation();		
			}elseif(empty($session)){
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
    				$this -> Session -> write('fiche_med');
    				
				//ne devrait pas etre dans le meme if
			}
			
 			// si on revient sur la page avec des informations déjà enregistrée
 			
 			
 			$antecedent = array();
 			$medicaments = array();
 			$buffer = array_merge((array)$session['antecedent1'], (array)$session['antecedent2'],(array)$session['antecedent3']);
 
  			foreach($buffer as $valeur){
 				$antecedent[] = $valeur;
 			}
 			
 			
 			foreach($session['medicamentautoriseLab'] as $valeur)
 			{
 					$medicaments[] = $valeur;
 			}
 		
 			
 			
 		$this->set('antecedents',$antecedent);
 		$this->set('resultmedicaments',$medicaments);
 		$this->set('peurs',$session['peur']);
 		$this->set('allergies',$session['allergie']);
 		$this->set('prescriptions',$session['prescription']);
 		
 		
 		
		$this->set('title_for_layout', __('Inscription d\'un enfant', true));
		$this->set('titre',__('Fiche médicale',true));
		$this->set('ariane', __('Informations générales > <span style="color: green;">Fiches médicales</span> > Autorisations', true));
		
		$this->loadModel("Maladie");
		$this->set('maladies', $this->getMaladieListe());
		
		$this->loadModel('QuestionGenerale');
		$this->set('questions', $this->getQuestionListe());
		
		$this->loadModel('Medicament');
		$this->set('medicaments', $this->getMedicamentListe());
		
		
		
	}
}
?>
