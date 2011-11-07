<?php
//App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class AdulteController extends AppController {

		 var $helpers = array('Html', 'Javascript');  
		 var $name = 'Adulte';

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

		}

}
?>
