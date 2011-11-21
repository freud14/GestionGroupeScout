<?php
//App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class ListeUniteController extends AppController {

		 var $helpers = array('Html', 'Form');  
		 var $name = 'ListeUnite';

		function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'admin';
			$this->loadModel('Unite');
			$this->loadModel('Enfant');
			$this->loadModel('Adulte');
			$this->loadModel('Compte');
			//$this->loadModel('autorisation_Compte');
		}


		/**
		 * Affiche l'ensemble des enfants selon leur unité.
		 * On peut changer l'affichage pour voir un tableau d'unité spécifique
		 * @todo  faire l'exportation excel
		 */
		 public function index() {
	
			
			$this->set('titre','Liste des unités');
			$this->set('ariane', __('<span style="color: green;">Liste </span> > Liste des unités', true));
			$this->set('title_for_layout', __('Liste des unités', true));
			$nomUnite = $this->_listeOption('Tous');
			//Si une valeure autre que tous a été choisie
		 	if ((!empty($this->data['ListeUnite']))&&($this->data['ListeUnite']['Afficher'] != "0")){
				
					$unite = $this->Unite->find('all', array('recursive' => 2, 
					'conditions' => array('Unite.Id' => $this->data['ListeUnite']['Afficher'],'Unite.Nom ' => $nomUnite)));
			} else {

					$unite = $this->Unite->find('all', array('recursive' => 2,'conditions' => array('Unite.Nom ' => $nomUnite)));
			
			}

			
			$this->set('unite', $unite);
		}
		/**
		*Retourne l'autorisation la plus haute du compte
		*
		*/
		function _getAutorisation()
		{
			$accesNum = null;
			$autorisation = $this-> Session -> read('authentification.autorisation');
			if(!empty($autorisation))
			{
				foreach ($autorisation as $valeur)
				{
					if($valeur['id'] > $accesNum)
					{
						$accesNum = $valeur['id'];
					}
				}
			}
			return $accesNum;
		}
		/**
		 * Définit les options pour les droplists
		 * Donne un nom au premier élément et met le nom
		 * des unités par la suite
		 */
		private function _listeOption($option1){
			 $autorisation = $this->_getAutorisation();
			//Permet d'afficher les éléments de la droplist
			$droplist = array();
			$option = array();
			$option[] = $option1;
			
			//s'il n'a pas d'autorisation (un parent) on le renvoit a laccueil
			if (empty($autorisation))
			{
				$this->redirect(array('controller'=>'accueil', 'action'=>'index'));
			}
			//si c'est un animateur on affiche juste les unites auquel il est assigné
			elseif ($autorisation == 1)
			{
			
				$unite = $this -> Compte ->find('all',array('recursive' => 2, 
										'conditions' => array(
										'Compte.Id' => $this -> Session-> read('authentification.id_compte')))
									);
				$unite = $unite['0']['Adulte']['0']['Unite'];
				foreach($unite as $valeur)
				{
					$option[$valeur['id']] = $valeur['nom'];
				}
			}
			else{
				$unite = $this->Unite->find('all');
				foreach($unite as $valeur){
					$option[$valeur['Unite']['id']] = $valeur['Unite']['nom'];
				}
				
				
			}
			
			
			$this->set('option', $option);
			return $option;

		}

		/**
		 * Permet d'assigner les jeunes à leur unité 
		 * @todo  faire l'exportation excel
		 */
		 public function assigner() {
		 	
			$this->set('titre','Assigner des jeunes dans une unité');
			$this->set('ariane', __('<span style="color: green;">Gestion des unités </span> > Assigner un jeune', true));
			$this->set('title_for_layout', __('Assigner un jeune', true));


			//Option pour la droplist
			$this->_listeOption('Jeunes non assignés');
					
			//Cherche les enfants et vérifie s'ils ont une unité pour distinguer les jeunes non assignés et assignés
			
			
			//Change la requête selon la sélection dans le droplist d'affichage, elle affiche les tableaux
		 	if (!empty($this->data['Voir'])){

				if($this->data['Voir']['Afficher'] == "0"){
					$unite = $this->Enfant->find('all', array('recursive' => 2));
				} else {

					$unite = $this->Enfant->find('all', array('recursive' => 2, 'conditions' => array('Unite.Id' => $this->data['ListeUnite']['Afficher'])));

				}	
			} else {

					$enfant = $this->Enfant->find('all', array('recursive' => 2));
			
			}
		 } 
		
}



?>
