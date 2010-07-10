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
 * Stores controller
 * 
 * This class controls the maintenance of the stores.
 *    
 * @author Mike Friesen
 *
 */
class StoresController extends AdminController {

	var $name = 'Store';
	var $viewPath = "store";
	var $components = array('Auth', 'RequestHandler', 'Kaching.ControllerUtil');	
	var $helpers = array('Html','Javascript', 'Ajax', 'Kaching.Date');
	var $uses = array('Kaching.Store', 'Kaching.Shippingzone', 'Kaching.Storesmtp');
	var $paginate = array('Store' => array('limit' => 20, 'order' => array('number' => 'asc')));	
	
	function index() {

		$stores = $this->paginate('Store');
		$this->set('stores', $stores);
	}
		
	function edit($id=null) {
		
		if (!empty($this->data)) {
			
			$this->Store->set($this->data);
			$this->Storesmtp->set($this->data);
			
			if ($this->__validateEdit()) {
				$this->Store->save($this->data);

				$this->data['Storesmtp']['store_id'] = $this->Store->id;
				$this->Storesmtp->save($this->data);
				$this->flash('Your Store has been saved.', 'index');
			}
			
		} else {
		
			if ($id != null && is_numeric($id)) {
				
				$this->Store->recursive = 1;
				$this->data = $this->Store->findById($id);
				
			} else {
				
				$store = $this->Store->findByNumber(1);
				if (empty($store)) {
					$this->data = array("Store"=>array("number"=>"1", "tax1"=>"0", "tax2"=>"0", "shipping_tax"=>"0", "service_fee"=>"0"));
				} else {
					$this->data = array("Store"=>array("tax1"=>"0", "tax2"=>"0", "shipping_tax"=>"0", "service_fee"=>"0"));
				}
			}
		}
	}
	
	function __validateEdit() {
				
		if ($this->__hasStoresmtpFields()) {
			return $this->Store->validates() && $this->Storesmtp->validates();
		}

		return $this->Store->validates();
	}
	
	function __hasStoresmtpFields() {
		
		if (isset($this->data['Storesmtp'])) {
			
			foreach ($this->data['Storesmtp'] as $i => $value) {
				
				if (strlen($value) > 0) {
					return true;
				}
			}
		}
		
		return false;
	}
	
	function delete($id=null) {
		
		if ($id != null && is_numeric($id)) {
			$this->Store->delete($id);
		}
		
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'stores', 'action' => "index"));
	}
	
	function shipping($id) {
		$this->Store->recursive = 1;
		$this->data = $this->Store->findById($id);
		
		$zones = $this->Shippingzone->find("list", array('fields'=> array('id','label'), 'order' => array('label' => 'asc')));
		$this->set(compact("zones"));
	}
	
	function deletezone($storeId=null, $zoneId=null) {
		
		if ($storeId != null && is_numeric($storeId) && $zoneId != null && is_numeric($zoneId)) {
			$condition = array ("store_id" => $storeId, "shippingzone_id" => $zoneId);
			$this->Store->StoreShippingzone->deleteAll($condition);
		}

		$this->redirect(array('plugin' => 'kaching', 'controller' => 'stores', 'action' => "index"));
	}
	
	function addzone() {

		if (!empty($this->data)) {
			$id = $this->data['Store']['id'];
			$shipping_id = $this->data['Shippingzone']['id'];
			
			$data = array('StoreShippingzone'=>array('store_id'=>$id, 'shippingzone_id'=>$shipping_id));

			$this->Store->StoreShippingzone->save($data);
		}
		
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'stores', 'action' => "shipping", $id));
	}	
	
	function holidays($id) {
		$this->Store->recursive = 1;
		$this->data = $this->Store->findById($id);
	}
	
	function addholiday($store_id) {

		if (!empty($this->data)) {

			$this->data['StoreHoliday']['store_id'] = $store_id;
			$this->Store->StoreHoliday->save($this->data);
		}
		
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'stores', 'action' => "holidays/$store_id"));
	}
	
	function deleteholiday($store_id, $holiday_id) {
		
		if ($store_id != null && is_numeric($store_id) && $holiday_id != null && is_numeric($holiday_id)) {
			$this->Store->StoreHoliday->delete($holiday_id);
		}

		$this->redirect(array('plugin' => 'kaching', 'controller' => 'stores', 'action' => "holidays/$store_id"));
	}
}
?>