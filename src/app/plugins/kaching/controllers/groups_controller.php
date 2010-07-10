<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.controllers
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Groups controller
 * 
 * This class controls the maintenance of the user groups.
 *    
 * @author Mike Friesen
 *
 */
require_once("admin_controller.php");

class GroupsController extends AdminController {
	
	var $name = 'Groups';
	var $viewPath = "group";
	var $helpers = array('Html', 'Javascript');
	var $components = array('Auth', 'Kaching.ControllerUtil');
	
	var $paginate = array('Group' => array('limit' => 20, 'order' => array('name' => 'asc')));
	
	function index() {
    	$this->data = $this->paginate('Group');
	}
	   
   	function edit($id=null) {

		if (!empty($this->data)) {
			
			$this->Group->set($this->data);
			if ($this->Group->validates()) {
				
				$this->Group->save($this->data);
				$this->flash('Group has been saved.', 'index');
			}
		}
		
		if ($id != null && is_numeric($id)) {
			$this->data = $this->Group->findById($id);
		}
	}

	function delete($id=null)
	{
		if ($id != null && is_numeric($id)) {
			$this->Group->delete($id);
		}
		
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'groups', 'action' => "search"));
	}
}
?>