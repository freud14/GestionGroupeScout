<?php
//App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class EnfantController extends AppController {

		 var $helpers = array('Html', 'Javascript', 'Form');  
		 var $name = 'enfant';
		// var $components = array(array('Recaptcha.Captcha' => array(
          //      'private_key' => '6Ldq4MkSAAAAACIFrlwaf209zjAOhktImcx_FjlS', 
            //    'public_key' => '6Ldq4MkSAAAAABiDfADZgxzR3Nn_wB4qppT9QBKy'))); 

		function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'admin';
		}


		/**
		 * view method
		 *
		 * @param string $id
		 * @return void
		 */
		 public function index() {
			$enfant = $this->Enfant->find('all');
			//$unite = $this->Enfant->find('all'


			pr($enfant);
			$this->set('titre','Liste des unités');
			$this->set('ariane', __('<span style="color: green;">Liste </span> > Liste des unités', true));
			$this->set('title_for_layout', __('Liste des unités', true));
			$this->set('enfant', $enfant);
		}

}
?>
