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
 * Shippingamounts controller
 * 
 * This class controls the maintenance of the Shipping amounts.
 *    
 * @author Mike Friesen
 *
 */
require_once("admin_controller.php");

class ShippingaliasesController extends AdminController {
	
	var $name = 'Shippingalias';
	var $viewPath = "shippingalias";
	var $components = array('Auth', 'RequestHandler', 'Kaching.ControllerUtil');	
	var $helpers = array('Html','Javascript', 'Ajax');
	var $uses = array("Kaching.Shippingalias", "Kaching.Shippingzone", "Kaching.Country", "Kaching.Region");
	
	/**
	 * Display the shipping aliases
	 * @param $id
	 */
	function index($shippingzone_id) {
		
		$this->Shippingzone->recursive = 1;
		$this->data = $this->Shippingzone->findById($shippingzone_id);
		$regions = $this->Region->find("list", array('fields'=> array('id','name'), "order"=>array("name"=>"asc")));
		$countries = $this->Country->find("list", array('fields'=> array('id','name'), "order"=>array("name"=>"asc")));
		
		$this->set(compact('regions', 'shippingzone', 'countries'));
	}
	
	/**
	 * Edits a shipping zone
	 * @param $id
	 */
	function edit($shippingzone_id=null, $id=null) {
		
		if (!empty($this->data)) {

			$shippingzone_id = $this->data['Shippingalias']['shippingzone_id'];

			if ($this->Shippingalias->save($this->data)) {
				$this->redirect(array('plugin' => 'kaching', 'controller' => 'shippingaliases', 'action' => "index/$shippingzone_id"));
			}
		}
		
		if ($shippingzone_id != null && is_numeric($shippingzone_id)) {
			$shippingzone = $this->Shippingzone->findById($shippingzone_id);
			$this->set("shippingzone", $shippingzone);
			$this->data['Shippingalias']['shippingzone_id'] = $shippingzone_id;
		}
		
		if ($id != null && is_numeric($id)) {
			$this->data = $this->Shippingalias->findById($id);
		}
	}
	
	function update_region_select() {
		
		if(!empty($this->data['Shippingalias']['country'])) {
			$this->data = $this->requestAction('/kaching/helpers/get_regions/'.$this->data['Shippingalias']['country']);
		}
	  
		$this->viewPath = "helper";	    
		$this->render("get_regions","blank");
	}
	
	/**
	 * Deletes shipping alias
	 * @param $id
	 */
	function delete($shippingzone_id, $id) {
		
		if (is_numeric($id)) {
			$this->Shippingalias->delete($id);
		}
		
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'shippingzones', 'action' => "index/$shippingzone_id"));
	}
}
?>