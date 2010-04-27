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
 * Shippingalias Model
 * 
 * @author Mike Friesen
 *
 */
class Shippingalias extends KachingAppModel {
	
	var $name = 'Shippingalias';
	
 	var $validate = array(
				 	'shippingzone_id' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Shipping Id is required'),
 					'region' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Region is required'),
 	  				'country' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Country is required'),
 					'postalcode' => array('rule' => 'validatePostalCode', 'required'=>false, 'message' => '* Only first 3 Postal Code characters is required')
    			);
    			
	function validatePostalCode($data) {
		
		if (isset($data['postalcode'])) {
			$country = $this->data['Shippingalias']['country'] ? $this->data['Shippingalias']['country'] : "";
			$postalcode = strlen($data['postalcode']) > 0 ? $data['postalcode'] : "";
			return !($country == "CA" && (strlen($postalcode) > 3));
		}
		
		return true;
	}
}
?>