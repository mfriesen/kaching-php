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
 * CategoriesXml controller
 * 
 * This class has methods for search / add / deleting categories via XML
 *    
 * @author Mike Friesen
 *
 */
class CategoriesXmlController extends AppController {
	
	var $viewPath = "kaching";		
	var $components = array('Auth', 'RequestHandler', 'Kaching.XmlWebservice');
	var $helpers = array('Xml');
	var $uses = array('Kaching.Category', 'Kaching.Product', 'Kaching.ProductCategory');

	function search($parentid=null) {
    			
    	if ($this->XmlWebservice->isValidUser($this->data)) {

		   	$conditions = $parentid == null ? array("parent_id is null") : array("Category.parent_id = ?" => array($parentid));
	       	$this->data = $this->Category->find("all", array("conditions"=>$conditions, "order"=>array("name" => "asc")));		
		}
    	
    	if (isset($this->params['requested'])) {
			return $this->data;
    	}
    	
    	$this->XmlWebservice->render();
    }
    
    function addproductcategory() {

    	$this->log($this->data);
    	
    	if ($this->XmlWebservice->isValidUser($this->data)) {

	    	if (!empty($this->data)) {

				$this->ProductCategory->create();
				$this->ProductCategory->set($this->data);
				$this->ProductCategory->save($this->data);
				
				$product_id = $this->data['ProductCategory']['product_id'];
				$this->__updateModifiedDate($product_id);
			}
		}
				
    	if (isset($this->params['requested'])) {
			return $this->data;
    	}
    	
    	$this->XmlWebservice->render();    	
    }
    
    function removeproductcategory() {

    	$this->log($this->data);
    	
    	if ($this->XmlWebservice->isValidUser($this->data)) {

	    	if (!empty($this->data)) {

	    		$category_id = $this->data['ProductCategory']['category_id'];
	    		$product_id = $this->data['ProductCategory']['product_id'];
	    		
	    		$conditions = array("ProductCategory.category_id = ? and ProductCategory.product_id = ?" => array($category_id, $product_id));
	    		$this->ProductCategory->deleteAll($conditions);
	    		
				$this->__updateModifiedDate($product_id);
			}
		}
				
    	if (isset($this->params['requested'])) {
			return $this->data;
    	}
    	
    	$this->XmlWebservice->render();    	
    }
    
	function __updateModifiedDate($id) {
    	
    	$product = $this->Product->findById($id);
    	$product['Product']['modified_date'] = date("Y-m-d G:i:s", time());
    	$this->Product->save($product);
    }
}
?>