<?php
class InformationGeneraleController extends AppController {
	var $name = 'InformationGenerale';
	var $helpers = array("Html",'Form');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'parent';
		setlocale(LC_ALL, 'fr_CA.utf8');
	}
	
	function index() {
		
		if (!empty($this->data)) {
		
		// Si c'est la page qui c'est rapeler elle meme avec de l'information
			$this->InformationGenerale->set($this->data);
			//if($this->InformationGenerale->validates()) {
				$this -> Session -> write("url", $this->params['url']);
				$this -> Session -> write('info_gen',$this->params['data']);
			//	pr($this->Session->read('info_gen.InformationGenerale'));
			//}	
			//
				$this->redirect(array('controller'=>'inscription_fiche_med', 'action'=>'index'));
		} else {	
			$informationGenerale = $this->Session->read('info_gen.InformationGenerale');
			//var_dump($informationGenerale);
			
			if (empty($informationGenerale)){
			
			//si c'est la variable les champs de la variable session n'existe pas ont les crées
				$informationGenerale = array(
					'nom' => "" , 'prenom' => "" , 'sexe' => "" , 
   					'date_de_naissance' => array('day' => "" , 'month' => "" , 'year' => ""),
   					'assurance_maladie' => "" , 'adresse' => "" , 'ville' => "" ,'code_postal' => "" , 'etab_scolaire' => "" , 
    					'niveau_scolaire' => "" , 'enseignant' => "" , 'groupe_age' => "" ,  'nom_tuteur' => "" , 
   					'prenom_tuteur' => "" , 'sexe_tuteur' => "" , 'courriel_tuteur' => "" , 'telephone_maison_tuteur' => "" , 
   					'telephone_bureau_tuteur' => "" , 'telephone_bureau_poste_tuteur' => "" , 'cellulaire_tuteur' => "" , 
    					'emploi_tuteur' => "" , 'nom_urgence' => "" , 'prenom_urgence' => "" , 'telephone_principal_urgence' => "" , 
    					'lien_jeune_urgence' => "" , 'particularite' => ""  );
    					$this->Session->write('info_gen', $informationGenerale);
    				
    				
			}
		}
		
		
		$this->set('title_for_layout', __('Inscription d\'un enfant', true));
		$this->set('titre', __('Informations générales', true));
		$this->set('ariane', __('<span style="color: green;">Informations générales</span> > Fiches médicales > Autorisations', true));
	
		$this->loadModel('GroupeAge');
		$this->set('groupe_age', $this->GroupeAge->find('all'));
		$informationGenerale = $this->Session->read('info_gen.InformationGenerale');
		$this->set('session',$informationGenerale);
	}
}
?>
