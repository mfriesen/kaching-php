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
 * ProductsXml controller
 * 
 * This class gives the ability to view products / edit products via xml
 *    
 * @author Mike Friesen
 *
 */
class ProductsXmlController extends AppController {
	
	var $viewPath = "kaching";
	var $components = array('Auth', 'RequestHandler', 'Kaching.ProductsUtil', 'Kaching.XmlWebservice');
	var $helpers = array('Xml');
	var $uses = array('Kaching.Product', 'Kaching.ProductStore', 'Kaching.Productsearch', 'Kaching.Store');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('view', 'save', 'search');
	}
		    
    function view($id=null) {
    			
    	if ($this->XmlWebservice->isValidUser($this->data)) {

			$this->data = $this->Product->findById($id);
			$this->data = $this->__fixImagePath($this->data);
			
			foreach ($this->data['ProductStore'] as $index => $ps) {
				$store = $this->Store->findById($ps['store_id']);
				$this->data['ProductStore'][$index]['Store'] = $store;
			}		
		}
    	
    	if (isset($this->params['requested'])) {
			return $this->data;
    	}
    	
    	$this->XmlWebservice->render();
    }
    
    function __fixImagePath($data) {
    	if (strlen($data['Product']['thumbnail']) > 0) {
			$thumbnail = Configure::read("kaching.product-thumbnail.url") . "/" . $data['Product']['thumbnail'];
			$data['Product']['thumbnail_url'] = $thumbnail;
		}
			
		if (strlen($data['Product']['image']) > 0) {
			$image = Configure::read("kaching.product-image.url") . "/" . $data['Product']['image'];
			$data['Product']['image_url'] = $image;
		}
		return $data;
    }
    
    function search() {

    	if ($this->XmlWebservice->isValidUser($this->data)) {

    		$retArray = array();
    		$this->Product->recursive = -1;
    		$q = isset($this->data['q']) ? $this->data['q'] : "";
			$conditions = array('Product.number like ? or Product.title like ?' => array("$q%", "%$q%"));
	       	$this->data = $this->Product->find("all", array("conditions"=>$conditions, "order"=>array("title" => "asc"), "limit"=>20));
	       	
	       	foreach ($this->data as $p) {
	       		$d = $this->__fixImagePath($p);
	       		array_push($retArray, $d);
	       	}
	       	
	       	$this->data = $retArray;
    	}
    	
    	if (isset($this->params['requested'])) {
			return $this->data;
    	}

    	$this->XmlWebservice->render();
    }
    
    function save() {
    	
    	if ($this->XmlWebservice->isValidUser($this->data)) {
    		
	    	if (!empty($this->data)) {

				$this->Product->set($this->data);
	
				if (!isset($this->data['Product']['id'])) {
					$this->data['Product']['inserted_date'] = date("Y-m-d G:i:s", time());
				}
				
				$this->data['Product']['modified_date'] = date("Y-m-d G:i:s", time());

				if (!$this->Product->save($this->data)) {
					$this->set("errors", $this->Product->invalidFields());
				}
			}
    	}
		
		if (isset($this->params['requested'])) {
			return $this->data;
    	}
    	
    	$this->XmlWebservice->render();
    }
    
    function save_product_store() {
 
    	$this->log($this->data);
    	if ($this->XmlWebservice->isValidUser($this->data)) {
    		
	    	if (!empty($this->data)) {

				$this->ProductStore->set($this->data);

				if ($this->ProductStore->save($this->data, false)) {
		    		$product_id = $this->data['ProductStore']['product_id'];
		    		$this->log($product_id);
					$this->ProductsUtil->updateModifiedDate($product_id);
				}
			}
    	}
		
		if (isset($this->params['requested'])) {
			return $this->data;
    	}
    	
    	$this->XmlWebservice->render();
    }    
}
?>