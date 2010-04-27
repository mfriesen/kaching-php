<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.controllers.components
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * ProductsUtil component
 * 
 * This class contains product helper methods 
 *    
 * @author Mike Friesen
 *
 */
class ProductsUtilComponent extends Object {
	
	function startup( &$controller ) {
		$this->controller = &$controller;
	}

	/**
	 * Update product's modified date to now
	 * @param $id
	 */
	function updateModifiedDate($id) {
    	
    	$product = $this->controller->Product->findById($id);    	
    	$this->controller->Product->set($product);
    	$this->controller->Product->saveField('modified_date', date("Y-m-d G:i:s", time()));
    }
    
    /**
     * Returns the ProductStore object for a product and store
     * @param $product
     * @param $store
     */
	function getProductStore($product, $store) {
		
		$storeId = $store['Store']['id'];
		$productId = $product['Product']['id'];
		$conditions = array('product_id' => $productId, 'store_id'=> $storeId);
		return $this->controller->ProductStore->find('first', array('conditions'=>$conditions));
	}
}
?>