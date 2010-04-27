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

App::import('Sanitize');

/**
 * Order Model
 * 
 * @author Mike Friesen
 *
 */
class Order extends KachingAppModel
{
	/* Order Status */
	var $incompleteStatus = 0;
	var $completedStatus = 1;
	var $paidAndIncompleteStatus = 2;
	var $refund = 3;
	var $cancelStatus = 99;
	
	var $name = 'Order';
	var $hasMany = array('Kaching.OrderDetail');
	var $belongsTo = array('Kaching.Store');
    
    var $validate = array(  				  	
    					'billto_email' => array(	array('rule' => 'email', 'message' => '* Email address is required', 'required'=>true),
    						array('rule' => array('validateMatch','billto_email', 'email_confirm'), 'message' => '* Email address does not match confirm email')),
						'credit_card' => array('rule' => 'notEmpty', 'message' => '* Credit Card Type is required'),
    					'credit_card_number' => array('rule' => array('cc', array('amex', 'visa','mc'), true, null), 'message' => '* Invalid Credit Card Number'),
						'credit_card_expiry' => array(
    										  			array('rule' => 'numeric','message'=>'* Invalid Expiry Date'),
    										  			array('rule' => array('validateExpiryDate','credit_card_expiry'), 'message' => '* Invalid Expiry Date')
    										  		 ),
       				  	'shipping' => array('rule' => 'notEmpty', 'message' => '* Shipping Amount is required'),
    					'shipping_tax' => array('rule' => 'notEmpty', 'message' => '* Shipping Tax is required'),
    					'store_id' => array('rule' => 'notEmpty', 'message' => '* Store is required')
    				);

    function __construct() {
    	
		parent::__construct();
		
		$newRules = Configure::read("kaching.validation.order");
		
		if (is_array($newRules)) {
			$this->validate = array_merge($this->validate, $newRules);
		}
	}

	function beforeSave() {
		
		if(isset($this->data['Order']['coupon_code'])) {
			$this->data['Order']['coupon_code'] = strtoupper($this->data['Order']['coupon_code']);
		}

		return true;
	}
    
    function validateExpiryDate($data, $field) {
    	
    	if (isset($data[$field]) && is_numeric($data[$field])) {
    		
    		if (strlen($data[$field]) == 4) {
    			$month = substr($data[$field], 0, 2);
    			$year =  2000+substr($data[$field], -2);
    			$date = mktime(0, 0, 0, $month, 1, $year);
    			
    			return $date > time();    			
    		}
    	}
    	return false;
    }
    
    function getMostPopularProductIds($start, $end) {

    	if ($start != null && strlen($start) > 0) {
    		
    		$insertedDate = " and inserted_date >= " . Sanitize::paranoid($start) . " ";
    		
    		if ($end != null && strlen($end) > 0) {
    			$insertedDate = " and inserted_date BETWEEN " . Sanitize::paranoid($start) . " AND " . Sanitize::paranoid($end) . " ";	
    		}
    		
	    	$sql = "select product_id, store_id, count(*) as count " . 
	    		"from order_details OrderDetail, orders `Order` " .
	    		"where `Order`.id=OrderDetail.order_id and `Order`.status= " . $this->completedStatus . $insertedDate .
	    		"group by `Order`.store_id, OrderDetail.product_id " .
	    		"order by count(*) desc, OrderDetail.product_id";
		}
    	
    	return $this->query($sql);
    }
}
?>