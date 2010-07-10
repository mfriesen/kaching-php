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
require_once("admin_controller.php");
/**
 * Shippingzones controller
 * 
 * This class controls the maintenance of the shipping zones.
 *    
 * @author Mike Friesen
 *
 */
class ShippingzonesController extends AdminController {
	
	var $name = 'Shippingzone';
	var $viewPath = "shippingzone";
	var $components = array('Auth', 'Security', 'RequestHandler', 'Kaching.ControllerUtil');	
	var $helpers = array('Html','Javascript', 'Ajax');
	var $paginate = array('Shippingzone' => array('limit' => 20, 'order' => array('label' => 'asc')));

	/**
	 * Displays all shipping zones
	 */
	function index() {
		
		$this->Shippingzone->recursive = 1;
		$this->data = $this->paginate('Shippingzone');
	}
	
	/**
	 * Edits a shipping zone
	 * @param $id
	 */
	function edit($id=null) {
		
		if (!empty($this->data)) {

			if ($this->Shippingzone->save($this->data)) {
				$id = $this->Shippingzone->id;
				$this->flash('Your shipping zone has been created.', 'edit/' . $id);
			}
		}
		
		if ($id != null && is_numeric($id)) {
			$shippingzone = $this->Shippingzone->findById($id);
        	$this->data = $shippingzone;
		}
	}
	
	/**
	 * Deletes shipping zone
	 * @param $id
	 */
	function delete($id=null) {
		
		if ($id != null && is_numeric($id)) {
			$this->Shippingzone->delete($id);
		}
		
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'shippingzones', 'action' => "index"));
	}
}
?>