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
 * ProductStore Model
 * 
 * @author Mike Friesen
 *
 */
class ProductStore extends KachingAppModel {
	var $name = 'ProductStore';
	 
 	var $validate = array(
					  	'store_id' => array('rule' => 'notEmpty', 'message' => '* Store is required'),
					    'product_id' => array('rule' => 'notEmpty', 'message' => '* Product is required'),
 						'retail_level_1' => array('rule' => 'numeric', 'message' => '* Retail is required'),
 						'retail_level_2' => array('rule' => 'numeric', 'message' => '* Retail is required'),
 						'retail_level_3' => array('rule' => 'numeric', 'message' => '* Retail is required'),
 						'discount_level_1' => array('rule' => 'numeric', 'message' => '* Discount is required'),
 						'discount_level_2' => array('rule' => 'numeric', 'message' => '* Discount is required'),
 						'discount_level_3' => array('rule' => 'numeric', 'message' => '* Discount is required'),
 						'qty_level_1_start' => array('rule' => 'numeric', 'message' => '* Qty is required'),
 						'qty_level_1_end' => array('rule' => 'numeric', 'message' => '* Qty is required'),
 						'qty_level_2_start' => array('rule' => 'numeric', 'message' => '* Qty is required'),
 						'qty_level_2_end' => array('rule' => 'numeric', 'message' => '* Qty is required'),
 						'qty_level_3_start' => array('rule' => 'numeric', 'message' => '* Qty is required'),
 						'qty_level_3_end' => array('rule' => 'numeric', 'message' => '* Qty is required')
    				);    				
}
?>