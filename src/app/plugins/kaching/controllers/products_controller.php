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
 * Products controller
 * 
 * This class controls the maintenance of the product.
 *    
 * @author Mike Friesen
 *
 */
require_once("admin_controller.php");

class ProductsController extends AdminController {
		
	var $name = 'Product';
	var $viewPath = "product";
	var $components = array('Auth', 'RequestHandler', 'Kaching.ControllerUtil', 'Kaching.ProductsUtil');
	var $helpers = array('Ajax', 'Date', 'Html', 'Javascript', 'Kaching.Cart');
	var $uses = array('Kaching.Product', 'Kaching.Category', 'Kaching.ProductCategory', 'Kaching.ProductStore', 'Kaching.Store');
	
    function view($id=null) {
    	
    	if (!empty($this->data)) {
    		
			$this->Product->set($this->data);
					
			if ($this->Product->validates()) {
				
				if (!isset($this->data['Product']['inserted_date'])) {
					$this->data['Product']['inserted_date'] = date("Y-m-d G:i:s", time());
				}
				
				$this->data['Product']['modified_date'] = date("Y-m-d G:i:s", time());

				if ($this->Product->save($this->data)) {
					$id = $this->Product->id;
					$this->flash('Your product has been saved.', 'view/' . $id);
				}				
			}
		} 
        
		if (strlen($id) > 0) {
			$product = $this->Product->findById($id);
	        $this->data = $product;
		}
				
        $defaultStore = $this->Store->findById(1);
        $this->set('defaultStore', $defaultStore);
    }
    
    function category($id) {

    	$product = $this->Product->findById($id);
	    $this->data = $product;

		$categories = $this->Category->find("threaded", array('order' => array('name' => 'asc')));
		$this->set(compact("categories"));	
    }

    function retail($id) {

    	$product = $this->Product->findById($id);
	    $this->data = $product;
	    
	    $stores = array();
	    foreach($product['ProductStore'] as $key => $value) {
	    	$storeId = $value['store_id'];
	    	$store = $this->Store->findById($storeId);
	    	$this->data['ProductStore'][$key] = array_merge($this->data['ProductStore'][$key], $store);
	    }
    }
    
    function deleteCategory($id, $productCategoryId) {
    	
    	$this->Product->ProductCategory->del($productCategoryId);
    	$this->ProductsUtil->updateModifiedDate($id);
    	$this->flash('Your category has been deleted.', 'view/' . $id);
    }
    
    function addcategory() {
    	
    	$id = $this->data['ProductCategory']['product_id'];

    	foreach($this->data['Category']['category_id'] as $key => $value) {
    		
			if($value != 0) {
				$this->ProductCategory->create();
				$category = array("product_id"=>$id, "category_id"=>$value);
				$this->ProductCategory->save($category);
			}
		}
		
     	$this->ProductsUtil->updateModifiedDate($id);
     	$this->redirect(array('plugin' => 'kaching', 'controller' => 'products', 'action' => "category", $id));
    }
    
    function editretail($product_id=null, $productStoreId=null) {
    	
    	if (!empty($this->data)) {
    		
    		$storeId = $this->data['ProductStore']['store_id'];
    		$product_id = $this->data['ProductStore']['product_id'];
    		
    		if ($this->data['ProductStore']['qty'] == 0) {
    			$this->data['ProductStore']['active'] = 0;
    		}
    		
    		if ($this->ProductStore->save($this->data)) {
    			
	    		$this->ProductsUtil->updateModifiedDate($product_id);
	    		$this->redirect("/kaching/products/retail/$product_id");
    		}
    	}

		$product = $this->Product->findById($product_id);
        $this->set('product', $product);
        
		$stores = $this->Store->find('list', array('order' => array('Name')));
        $this->set('stores', $stores);	
		
		if ($productStoreId != null) {
			$productStore = $this->ProductStore->findById($productStoreId);
			$this->data = $productStore;
		} else {
			$this->data = array("ProductStore"=>array("discount_level_1"=>"0", "qty_level_1_start"=>"0", "qty_level_1_end"=>"0", 
				"retail_level_2"=>"0", "discount_level_2"=>"0", "qty_level_2_start"=>"0", "qty_level_2_end"=>"0",
				"retail_level_3"=>"0", "discount_level_3"=>"0", "qty_level_3_start"=>"0", "qty_level_3_end"=>"0",
				"qty"=>"-1"));
		}
		
		$tax1list = $this->Store->find("list", array('fields'=> array('id','tax1name')));
		$this->set(compact("tax1list"));
		
		$tax2list = $this->Store->find("list", array('fields'=> array('id','tax2name')));
		$this->set(compact("tax2list"));
    }
    
    function deleteRetail($id, $productStoreId) {
    	
    	$this->Product->ProductStore->del($productStoreId);
    	$this->ProductsUtil->updateModifiedDate($id);
    	$this->flash('Retail has been deleted.', 'view/' . $id);
    }
    
    function enable($id, $productStoreId) {
    	
    	$productStore = $this->Product->ProductStore->findById($productStoreId);
    	$productStore['ProductStore']['active'] = 1;
    	$this->Product->ProductStore->save($productStore);
    	$this->ProductsUtil->updateModifiedDate($id);
    	$this->flash('Your product has been enabled.', 'view/' . $id);
    }
    
    function disable($id, $productStoreId) {
    	
        $productStore = $this->Product->ProductStore->findById($productStoreId);
    	$productStore['ProductStore']['active'] = 0;
    	$this->Product->ProductStore->save($productStore);
    	$this->ProductsUtil->updateModifiedDate($id);
    	$this->flash('Your product has been disabled.', 'view/' . $id);
    }

    function addthumbnail($id) {

    	$product = $this->Product->findById($id);    	
    	
    	if (!empty($this->data['Product']) && is_uploaded_file($this->data['Product']['thumbnail']['tmp_name']) && strpos($this->data['Product']['thumbnail']['tmp_name'], '/tmp') === 0)
        {
        	$file = $this->data['Product']['thumbnail']['tmp_name'];
        	
        	$thumbnailDirectory = Configure::read('kaching.product-thumbnail.dir');
        	$path = $thumbnailDirectory . "/" . $product['Product']['thumbnail'];
        	$this->__saveFile($file, $path);
			$this->flash('Thumbnail has been added.', 'images/' . $id);
        }
    	else {
    		$this->flash('No Thumbnail Image found to upload.', 'images/' . $id);
    	}    	
    }
    
    function addimage($id) {

    	$product = $this->Product->findById($id);

    	if (!empty($this->data['Product']) && is_uploaded_file($this->data['Product']['image']['tmp_name']) && strpos($this->data['Product']['image']['tmp_name'], '/tmp') === 0)
        {
        	$file = $this->data['Product']['image']['tmp_name'];
        	
        	$imageDirectory = Configure::read('kaching.product-image.dir');
        	$path = $imageDirectory . "/" . $product['Product']['image'];
        	$this->__saveFile($file, $path);
			$this->flash('Image has been added.', 'images/' . $id);
        }
    	else {
    		$this->flash('No Image found to upload.', 'images/' . $id);
    	}    	
    }
    
    function __saveFile($url, $localpath) {
    	
    	$file = fopen ($url, "rb");
		$newf = fopen ($localpath, "wb");

		while(!feof($file)) 
		{
			fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
		}

		fclose($file);
		fclose($newf);
    }
    
    function images($id) {
    	
    	$product = $this->Product->findById($id);
	    $this->data = $product;
    }
}
?>