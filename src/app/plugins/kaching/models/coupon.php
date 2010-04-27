<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.models
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Coupon Model
 * 
 * @author Mike Friesen
 *
 */
class Coupon extends KachingAppModel {
	
	var $name = 'Coupon';
 
 	var $validate = array(
				    'title' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Title is required'),
 					'store_id' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Store is required'),
 					'percent' => array(
 						array('rule' => 'numeric', 'required'=>true, 'message' => '* Percent Discount is required'), 
 						array('rule' => 'validatePercentOrAmount', 'message' => '* Percent or Amount is required'), 
 					),
 					'shipping_percent' => array('rule' => 'numeric', 'required'=>true, 'message' => '* Shipping Percent is required'),
				 	'amount' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Amount is required'),
				 	'start' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Start Date is required'),
				 	'end' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* End Date is required'),
 					'code' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Code is required')
    			);
    						
    function validatePercentOrAmount($data) {
    	
    	if (isset($this->data[$this->name]["percent"]) && isset($this->data[$this->name]["amount"]) && isset($this->data[$this->name]["shipping_percent"])) {
    		return !($this->data[$this->name]["percent"] == 0 && $this->data[$this->name]["amount"] == 0 && $this->data[$this->name]["shipping_percent"] == 0);
    	}
    	
    	return true;
    }
    
    function findByStoreAndCode($store_id, $coupon_code) {
    	$conditions = array("code"=>$coupon_code, "store_id"=>$store_id);
    	$coupon = $this->find("first", array("conditions"=>$conditions));
    	return $coupon;
    }
    
    function isActive($store_id, $coupon_code) {
    	
		if (strlen($coupon_code) > 0) {
			
			$today = date("Y-m-d");
			$conditions = array('? BETWEEN Coupon.start AND Coupon.end' => array($today), 
				"code"=>$coupon_code, "store_id"=>$store_id);
			$coupon = $this->find("first", array("conditions"=>$conditions));

			return !empty($coupon);
		}

		return false;    	
    }    
}

?>