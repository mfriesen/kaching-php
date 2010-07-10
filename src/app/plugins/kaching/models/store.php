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
 * Store Model
 * 
 * @author Mike Friesen
 *
 */
class Store extends KachingAppModel {
	
	var $name = 'Store';
	var $recursive = -1;

	var $hasOne = array('Storesmtp' => array('className' => 'Kaching.Storesmtp'));
	var $hasMany = array('StoreHoliday' => array('className' => 'Kaching.StoreHoliday', 'order' => 'StoreHoliday.date desc')); 
	
	var $hasAndBelongsToMany = array(
		'Shippingzone' =>
			array( 	'className' => 'Kaching.Shippingzone',
					'joinTable' => 'store_shippingzones',
					'foreignKey' => 'store_id',
					'associationForeignKey' => 'shippingzone_id',
					'order' => 'Shippingzone.label',
					'unique' => false
				 )
	);
	
  	var $validate = array(
  				'number' => array(
    							array('rule' => 'numeric', 'required'=>true, 'message'=>'* Number is required'),
    							array('rule' => array('verifyStore1'), 'message' => '* Number must be 1'),
    							array('rule' => array('verifyNewStore'), 'message' => '* Store Number already exists')
    							 ),
  				'name' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Name is required'),
  				'website' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Website is required'),
  				'email' => array('rule' => 'email', 'required'=>true, 'message' => '* Email is required'),
  				'tax1' => array('rule' => 'numeric', 'required'=>true, 'message' => '* Tax1 is required'),
  				'tax2' => array('rule' => 'numeric', 'required'=>true, 'message' => '* Tax2 is required'),
    			'tax1name' => array('rule' => array('verifyHasTax', 'tax1'), 'required'=>true, 'message' => '* Tax1 Name is required'),
				'tax2name' => array('rule' => array('verifyHasTax', 'tax2'), 'required'=>true, 'message' => '* Tax2 Name is required'),
  				'shipping_tax' => array('rule' => 'numeric', 'required'=>true, 'message' => '* Shipping Tax is required'),
  				'service_fee' => array('rule' => 'numeric', 'required'=>true, 'message' => '* Service Fee is required'),
  				'payment_process' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Payment Process is required'),
  				'currency' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Currency is required')
    		);
	
    function verifyStore1($data) {

    	if ($data['number'] != 1) {
    		$store = $this->findByNumber(1);
    		return !empty($store);
    	} 

    	return true;
    }
    
    function verifyNewStore($data) {
    	
    	$id = isset($this->data['Store']['id']) ? $this->data['Store']['id'] : "";
    	
    	if (strlen($id) > 0) {
    		return true;
    	}
    	
    	$store = $this->findByNumber($data['number']);
    	return empty($store);
    }
    
    function verifyHasTax($data, $field) {
    	
    	$tax = isset($this->data['Store'][$field]) ? $this->data['Store'][$field] : 0;
    	$name = isset($this->data['Store'][$field . "name"]) ? $this->data['Store'][$field . "name"] : "";
    	return !($tax > 0 && strlen($name) == 0);
    }
}

?>