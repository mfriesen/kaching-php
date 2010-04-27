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
 * Coupons controller
 * 
 * This class controls maintenance of the kaching coupons.
 *    
 * @author Mike Friesen
 *
 */
require_once("admin_controller.php");

class CouponsController extends AdminController {
	
	var $name = 'Coupon';
	var $viewPath = "coupon";
	var $components = array('Auth', 'Kaching.ControllerUtil');
	var $uses = array("Kaching.Coupon", "Kaching.Store");
	var $helpers = array('Ajax', 'Session', 'Html', 'Javascript', 'Date');
	var $paginate = array('Coupon' => array('limit' => 10, 'order' => array('end' => 'desc', 'start' => 'desc', 'title'=>'asc')));
	
	/**
	 * Display all the coupons in the system
	 */
    function index() {    	
    	$this->data = $this->paginate('Coupon');
    }
    
    /**
     * Editing of a coupon
     * @param $id
     */
    function edit($id=null) {
		
    	if (!empty($this->data)) {

			$code = isset($this->data['Coupon']['code']) ? strtoupper($this->data['Coupon']['code']) : "";
			$this->data['Coupon']['code'] = $code;
		 
			if ($this->Coupon->save($this->data)) {
				$this->flash('Coupon has been saved.', 'index');
			}
    	}
    	
		if ($id != null && is_numeric($id)) {
			
			$coupon = $this->Coupon->findById($id);
        	$this->data = $coupon;
		}

		$stores = $this->Store->find('list', array('order' => array('Name')));
        $this->set('stores', $stores);
	}
    
	/**
	 * Delete a coupon
	 * @param $id
	 */
	function delete($id=null) {
		
		if ($id != null && is_numeric($id)) {
			$this->Coupon->del($id);
		}
		
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'coupons', 'action' => "index"));
	}
}
?>