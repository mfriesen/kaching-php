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
 * Shippingamounts controller
 * 
 * This class controls the maintenance of the Shipping amounts.
 *    
 * @author Mike Friesen
 *
 */
class ShippingamountsController extends AdminController {
	
	var $name = 'Shippingamount';
	var $viewPath = "shippingamount";
	var $components = array('Auth', 'RequestHandler', 'Kaching.ControllerUtil');	
	var $helpers = array('Html','Javascript', 'Ajax');
	var $uses = array('Kaching.Shippingamount', 'Kaching.Shippingzone');
	
	/**
	 * Display the shipping amounts / weights
	 * @param $id
	 */
	function index($shippingzone_id) {
		
		$this->Shippingzone->recursive = 1;
		$this->data = $this->Shippingzone->findById($shippingzone_id);
	}
	
	function edit($shippingzone_id=null, $amountId=null) {

		if (!empty($this->data)) {

			$shippingzone_id = $this->data['Shippingamount']['shippingzone_id'];
			
			if ($this->Shippingzone->Shippingamount->save($this->data)) {
				$this->redirect(array('plugin' => 'kaching', 'controller' => 'shippingamounts', 'action' => "index/$shippingzone_id"));
			}
			
		}
			
		if ($amountId != null) {
				
			$this->data = $this->Shippingzone->Shippingamount->findById($amountId);	
		} else {
			$this->data['Shippingamount']['weight'] = 0;
		}
						
		$shippingzone = $this->Shippingzone->findById($shippingzone_id);
		$this->set('shippingzone', $shippingzone);		
	}
	
	function delete($id=null) {
		
		if ($id != null && is_numeric($id)) {
			$this->Shippingamount->delete($id);
		}
		
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'shippingzones', 'action' => "index"));
	}
}
?>