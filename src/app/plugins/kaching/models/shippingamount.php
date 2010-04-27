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
 * Shippingamount Model
 * 
 * @author Mike Friesen
 *
 */
class Shippingamount extends KachingAppModel {
	
	var $name = 'Shippingamount';
	
  	var $validate = array(
			  	'amount' => array('rule' => 'numeric', 'message' => '* Amount is required'),
  				'weight' => array(
  									array('rule' => 'numeric', 'message' => '* Invalid Weight'),
    								array('rule' => 'validateWeight', 'message' => '* Duplicate weight entered')
  								 )
  				);
  	
  	function validateWeight($data) {
  		$id = isset($this->data['Shippingamount']['id']) ? $this->data['Shippingamount']['id'] : "";
  		$weight = $this->data['Shippingamount']['weight'];
  		$shippingZoneId = $this->data['Shippingamount']['shippingzone_id'];
  		
  		$condition = array("Shippingamount.weight" => $weight, "Shippingamount.shippingzone_id" => $shippingZoneId);
    	$list = $this->find('list', array("conditions" => $condition));

    	return empty($list) || (sizeof($list) == 1 && array_key_exists($id, $list));
  	}
}
?>