<?php
//App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class InscrireAdulteController extends AppController {

		 var $helpers = array('Html', 'Javascript', 'Form');  
		 var $name = 'InscrireAdulte';
		// var $components = array(array('Recaptcha.Captcha' => array(
          //      'private_key' => '6Ldq4MkSAAAAACIFrlwaf209zjAOhktImcx_FjlS', 
            //    'public_key' => '6Ldq4MkSAAAAABiDfADZgxzR3Nn_wB4qppT9QBKy'))); 

		function beforeFilter(){
			parent::beforeFilter();
			$this->layout = 'parent';
		}


		/**
		 * view method
		 *
		 * @param string $id
		 * @return void
		 */
		 public function view() {
			}

		/**
		 * add method
		 *
		 * @return void
		 */
		public function inscription() {

			$this->set('titre','Devenir un membre');
			$this->set('ariane', __('<span style="color: green;">Inscription d\'un membre', true));
			$this->set('title_for_layout', __('Inscription d\'un membre', true));

			if (!empty($this->data)) {
					$this->InscrireAdulte->set($this->data);
					
					if($this->InscrireAdulte->validates()) {
						echo "valide";
					} else {
						echo "invalide";
					}
					pr($this->InscrireAdulte->invalidFields());
				}
			

		}

}
?>