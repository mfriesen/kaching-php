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
App::import('Sanitize');

/**
 * Shopping carts controller
 * 
 * This class controls interaction with the shopping cart. 
 * From adding / remove products, searching the store and view products.
 *    
 * @author Mike Friesen
 *
 */
class CartsController extends KachingAppController {
	
	var $name = 'cart';
	var $uses = array('Kaching.Product', 'Kaching.Coupon', 'Kaching.Order', 'Kaching.OrderDetail', 'Kaching.Category', 'Kaching.ProductCategory',  
		'Kaching.ProductStore', 'Kaching.Shippingzone', 'Kaching.Store', 'Kaching.Shippingalias');
	
	var $viewPath = "carts";
	var $layout = "carts";
	var $helpers = array('Ajax', 'Session', 'Html', 'Javascript', 'Kaching.Cart');
	var $components = array('RequestHandler', 'Kaching.ControllerUtil', 'Kaching.ProductsUtil', 
		'Kaching.ShippingCalculator', 'Kaching.Cart');
	
	var $paginate = array('Product');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->ControllerUtil->forceNonSsl();
	}
	
	/**
	 * Searches for products that match a criteria
	 * All parameters use the named parameters
	 * @param q - the criteria to search for in the number, title, description fields
	 * @param limit - limit the return results
	 * @param store - which store number to search
	 * @param active - 1 - Active products, 0 - Inactive products
	 * @param pricefilter - return products within price range
	 * @param category_id - filter results by category
	 */
	function search() {
		
		if ($this->RequestHandler->isPost()) {
			
			$q = isset($this->data['Cart']['q']) ? $this->data['Cart']['q'] : "";
			$limit = isset($this->data['Cart']['limit']) ? $this->data['Cart']['limit'] : 0;
			$storeNumber = isset($this->data['Cart']['store']) ? $this->data['Cart']['store'] : 1;
			$active = isset($this->data['Cart']['active']) ? $this->data['Cart']['active'] : 1;
			$pricefilter = isset($this->data['Cart']['pricefilter']) ? $this->data['Cart']['pricefilter'] : null;
			$category_id = isset($this->data['Cart']['category']) ? $this->data['Cart']['category'] : null;
			
			$this->redirect("/kaching/Carts/search/q:$q/limit:$limit/store:$storeNumber/active:$active/pricefilter:$pricefilter/category:$category_id");
		}
		
		$q = isset($this->passedArgs['q']) ? $this->passedArgs['q'] : "";
		$limit = isset($this->passedArgs['limit']) ? $this->passedArgs['limit'] : 0;
		$storeNumber = isset($this->passedArgs['store']) ? $this->passedArgs['store'] : 1;
		$active = isset($this->passedArgs['active']) ? $this->passedArgs['active'] : 1;
		$pricefilter = isset($this->passedArgs['pricefilter']) ? $this->passedArgs['pricefilter'] : null;
		$category_id = isset($this->passedArgs['category']) ? $this->passedArgs['category'] : null;
		$page = isset($this->passedArgs['page']) ? $this->passedArgs['page'] : 1;
		
		$active = $active == -1 ? null : $active;
		
		if (strlen($q) > 0) {
			
			$products = $this->get_products($category_id, $pricefilter, $q, $active, $storeNumber, $limit);
			$products = empty($products) ? array() : $products;

			if (count($products) == 1 && $page == 1) {
				$id = $products[0]['Product']['id'];
				$this->redirect(array('plugin' => 'kaching', 'controller' => 'carts', 'action' => "product/id:$id/store:$storeNumber"));
			} else {

				$store = $this->Store->findByNumber($storeNumber);
				$this->set("q", $q);
				$this->set("pricefilter", $pricefilter);
				$this->set("limit", $limit);
				$this->set('store', $store);
				$this->set('order', $this->Cart->get($store));
				$this->set('products', $products);
						    	
				if ($category_id != null) {
					$this->set('category', $this->Category->findById($category_id));
				}
			}			
		} else {
			$this->redirect("/");
		}
	}

	/**
	 * Get a categories listing
	 * All parameters use the named parameters
	 * @param $parent - filter categories by parent_id and active
	 * @param active - 1 - Active categories, 0 - Inactive categories
	 * @return Category array
	 */
	function get_categories() {
		$parent_id = isset($this->passedArgs['parent']) ? $this->passedArgs['parent'] : null;
		$active = isset($this->passedArgs['active']) ? $this->passedArgs['active'] : 1;	
		
		if ($parent_id == null) {
			$conditions = array("active"=>$active);
		} else {
			$conditions = array("active"=>$active, "or"=>array("parent_id"=>$parent_id, "id"=>$parent_id));
		}
		
		$categories = $this->Category->find('threaded', array('conditions'=>$conditions, 'order' => array('name')));
				
		return $categories;
	}	
	
	/**
	 * View Product - either id, number or page is required.
	 * All parameters use the named parameters
	 * @param id - find product by id
	 * @param number - find product by number
	 * @param page - find product by page
	 * @param store - which store we are in
	 */
	function product() {
		
		$id = isset($this->passedArgs['id']) ? $this->passedArgs['id'] : null;
		$number = isset($this->passedArgs['number']) ? $this->passedArgs['number'] : null;
		$storeNumber = isset($this->passedArgs['store']) ? $this->passedArgs['store'] : 1;
		
		if ($id != null)
			$product = $this->Product->findById($id);
		else if ($number != null)
			$product = $this->Product->findByNumber($number);

		if (isset($product) && !empty($product)) {
			$this->__product($product, $storeNumber);
			
			if (isset($this->params['requested'])) {
				return $product;
			}
		} else {
			$this->redirect("/");
		}
	}
	
	/**
	 * In order the use this method the following line needs to be added to the routes.php file
	 * Router::connect('/product/*', array('plugin'=>'kaching', 'controller' => 'carts', 'action' => 'product_page'));
	 * @param $page - the product page to retrieve
	 * Named Parameters 
 	 * @param store - which store we are in
	 */
	function product_page($page) {
		
		$product = $this->Product->findByPage($page);
		$storeNumber = isset($this->passedArgs['store']) ? $this->passedArgs['store'] : 1;
		
		if (!empty($product)) {
			$this->__product($product, $storeNumber);
			
			if (isset($this->params['requested'])) {
				return $product;
			}
			
			$this->render("product");
		} else {
			$this->redirect("/");
		}
	}
	
	function __product(&$product, $storeNumber) {
		$store = $this->Store->findByNumber($storeNumber);
		$this->set('store', $store);
			
		$cart = $this->Cart->get($store);
		$this->set('order', $cart);
			
		$productStore = $this->ProductsUtil->getProductStore($product, $store);
		if (!empty($productStore)) {
			$product = array_merge($product, $productStore);
		}
			
		$this->set('product', $product);
	}
		
	/**
	 * View Cart
	 * All parameters use the named parameters
	 * @param store - which store we are in, default 1
	 */
	function view() {
		
		$storeNumber = isset($this->passedArgs['store']) ? $this->passedArgs['store'] : 1;

    	$store = $this->Store->findByNumber($storeNumber);
    	$this->set('store', $store);
    	
		$cart = $this->Cart->get($store);
		$this->data = $cart;
		
		if (isset($cart['Order']['coupon_code']) && strlen($cart['Order']['coupon_code']) > 0) {
			$coupon = $this->Coupon->findByStoreAndCode($cart['Order']['store_id'], $cart['Order']['coupon_code']);
			$this->set('coupon', $coupon);
		}
	}
	
	/**
	 * Displays products in a category
	 * @param $category_id - either category_id or the page of the category;
	 */
	function category($category_id) {

		$limit = isset($this->passedArgs['limit']) ? $this->passedArgs['limit'] : 0;
		$storeNumber = isset($this->passedArgs['store']) ? $this->passedArgs['store'] : 1;
		$pricefilter = isset($this->passedArgs['pricefilter']) ? $this->passedArgs['pricefilter'] : null;
		$active = isset($this->passedArgs['active']) ? $this->passedArgs['active'] : 1;

		$category = is_numeric($category_id) ? $this->Category->findById($category_id) : $this->Category->findByPage($category_id);
		$category_id = $category['Category']['id'];
		
		$products = $this->get_products($category_id, $pricefilter, null, $active, $storeNumber, $limit);
		$products = empty($products) ? array() : $products;
		
		if (isset($this->params['requested'])) {
			return $products;
		}
		
		$store = $this->Store->findByNumber($storeNumber);
		$cart = $this->Cart->get($store);
		
		$this->set("pricefilter", $pricefilter);
		$this->set("limit", $limit);
		$this->set('store', $store);
		$this->set('order', $cart);
		$this->set('products', $products);
		$this->set('category', $category);
	}
	
	function get_products($category_id=null, $pricefilter=null, $q=null, $active=1, $storenumber, $limit) {
		
		$joins = array(
						array('table' => 'product_stores', 'alias' => 'ProductStore', 'type' => 'INNER', 'conditions' => array( 'ProductStore.product_id = Product.id')),
						array('table' => 'stores', 'alias' => 'Store', 'type' => 'INNER', 'conditions' => array( 'ProductStore.store_id = Store.id'))
					  );

		$fields = array("Product.*", "ProductStore.*");
		$order = array("retail_level_1"=>"asc");
		
		$conditions = array('Store.number' => $storenumber);
		$conditions['ProductStore.active'] = $active;
		
		if ($category_id != null) {
			array_push($joins, array('table' => 'product_categories', 'alias' => 'ProductCategory', 'type' => 'INNER', 'conditions' => array( 'ProductCategory.product_id = Product.id')));
			$conditions['ProductCategory.category_id'] = $category_id;
		}
		
		if ($pricefilter != null && strstr($pricefilter, "-")) {
			
			list($price0, $price1) = preg_split("/[-]/", $pricefilter);
			$price0 = is_numeric($price0) ? $price0 : "";
			$price1 = is_numeric($price1) ? $price1 : "";
			
			if (strlen($price1) > 0) {
				$conditions['ProductStore.retail_level_1 between ? and ?'] = array($price0, $price1);	
			} else {
				$conditions['ProductStore.retail_level_1 >= ?'] = $price0;
			}
		}
		
		if ($q != null) {
			$conditions['(Product.number like ? or Product.title like ? or Product.description like ? or Product.keywords like ?)'] = array("%$q%", "%$q%", "%$q%", "%$q%");
		}

		$this->Product->recursive = -1;
		
		if ($limit > 0) {
			$this->paginate = array( 'fields' => $fields,'conditions' => $conditions,'limit' => $limit, 'joins'=>$joins, 'order'=>$order);
			$products = $this->paginate('Product');
		} else {
			$products = $this->Product->find("all", array( 'fields' => $fields,'conditions' => $conditions, 'joins'=>$joins, 'order'=>$order));
		}

		return $products;
	}
	
	/**
	 * Handles Add to Cart via post
	 */
	function __addPost() {
		
		$storeNumber = $this->data['Store']['number'];
		
		foreach ($this->data['OrderDetail'] as $index => $detail):
			$id = $detail['product_id'];
			$qty = isset($detail['qty']) ? $detail['qty'] : 0;
			$retail = isset($detail['retail']) ? $detail['retail'] : 0;
			
			if ($qty > 0) {
				$this->__addProductsToCart($id, $qty, $retail, $storeNumber, $detail);
			}
		endforeach;
		
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'carts', 'action' => 'view'));
	}
	
	/**
	 * Adds products to cart
	 * @param $id
	 * @param $qty
	 * @param $retail
	 * @param $storeNumber
	 * @param $extra - extra Order Detail values
	 * @return TRUE if successful adding products to cart
	 */
	function __addProductsToCart($id, $qty=1, $retail=0, $store_number=1, $extra=null) {
		
		$store = $this->Store->findByNumber($store_number);
			
		$cart = $this->Cart->get($store);
		
		$product = $this->__getProduct($id);
		if ($this->__isProductActive($product, $store)) {
			$retail = $this->__getRetail($product, $retail, $store_number, $qty);
	
			$ps = $this->ProductsUtil->getProductStore($product, $store);
			
			$detail = $this->__createDetail($product, $ps, $retail, $qty, $extra);
			
			array_push($cart['OrderDetail'], $detail);

			$cart = $this->Cart->recalculate($cart, $store);
			
			$this->Cart->save($cart, $store_number);
			return true;
		}
		
		return false;
	}
	
	/**
	 * Add product to shopping cart. Then forwards to shopping cart view
	 * @param id - product id to add to cart
	 * @param qty - qty of product
	 * @param retail - retail for product
	 * @param store - the store number
	 * @param url - the url to redirect to on successful adding product to cart
	 */
	function add() {
		
		$id = isset($this->passedArgs['id']) ? $this->passedArgs['id'] : -1;
		$qty = isset($this->passedArgs['qty']) ? $this->passedArgs['qty'] : 1;
		$retail = isset($this->passedArgs['retail']) ? $this->passedArgs['retail'] : 0;
		$storeNumber = isset($this->passedArgs['store']) ? $this->passedArgs['store'] : 1;
		$url = isset($this->passedArgs['url']) ? $this->passedArgs['url'] : null;
		
		if ($this->RequestHandler->isPost()) {
			
			$this->__addPost();
		} else {
			
			if ($this->__addProductsToCart($id, $qty, $retail, $storeNumber, null)) {
				
				if ($url != null) {
					$this->redirect("/$url");
				} else {
					$this->redirect(array('plugin' => 'kaching', 'controller' => 'carts', 'action' => 'view'));
				}
				
			} else {
				$this->redirect(array('plugin' => 'kaching', 'controller' => 'carts', 'action' => 'product', $id));
			}
		}
	}
	
	/**
	 * sets Coupon Code
	 * @param coupon_code - the coupon code to apply to shopping cart
	 */
	function set_coupon() {
		
		$coupon_code = isset($this->data['Order']['coupon_code']) ? strtoupper($this->data['Order']['coupon_code']) : "";
		$coupon_code = isset($this->passedArgs['coupon_code']) ? $this->passedArgs['coupon_code'] : $couponCode;
		$store_number = isset($this->passedArgs['store']) ? $this->passedArgs['store'] : 1;

		$store = $this->Store->findByNumber($store_number);
		$cart = $this->Cart->get($store);
		
		$cart = $this->cart->set_coupon($cart, $coupon_code);
		$this->cart->save($cart, $store_number);

		$errors = $this->Order->invalidFields();
		
		if (empty($errors)) {
			$this->redirect(array('plugin' => 'kaching', 'controller' => 'carts', 'action' => 'view'));
		} else {
			$this->view();
			$this->render('view');
		}
	}
		
	/**
	 * Remove index from shopping cart
	 * @param $index
	 * @param store
	 */
	function remove() {
		
		$index = isset($this->passedArgs['index']) ? $this->passedArgs['index'] : -1;
		$store_number = isset($this->passedArgs['store']) ? $this->passedArgs['store'] : 1;
		
		if ($index > -1) {
			
			$store = $this->Store->findByNumber($store_number);
			$cart = $this->Cart->get($store);
			
			if (isset($cart['OrderDetail'][$index])) {
				
				unset($cart['OrderDetail'][$index]);
				
				$cart = $this->Cart->recalculate($cart, $store);
				
				$this->Cart->save($cart, $store_number);		
			}
		}
		
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'carts', 'action' => 'view'));
	}
	
	/**
	 * Is Product Active
	 * @param $product
	 * @param $storeNumber
	 * @return TRUE / FALSE
	 */
	function __isProductActive($product, $store) {
		
		$s = $this->ProductsUtil->getProductStore($product, $store);
		
		if ($s != null)
		{
			$qty = $s['ProductStore']['qty'];
			$active = $s['ProductStore']['active'] == 1;
			$validQty = $qty != 0;
			return $active && $validQty;
		}
		
		return false;
	}
		
	function __getProduct($id) {
		
		return $this->Product->findById($id);
	}
	
	function __createDetail($product, $productStore, $retail, $qty, $extra) {
		
		$detail = array_merge(array(), $product);
		$detail = array_merge($detail, $productStore);
		
		if ($extra != null)
			$detail = array_merge($detail, $extra);
			
		$detail['product_id'] = $product['Product']['id'];
		$detail['retail'] = $retail;		
		$detail['qty'] = $qty;
		
		return $detail;
	}
	
	function __isRetailMatch($retail, $compareRetail) { return $compareRetail > 0 && number_format($retail,2) == number_format($compareRetail,2); }
		
	function __getRetail($product, $retail, $storeNumber, $qty) {
				
		$store = $this->Store->findByNumber($storeNumber);
		$s = $this->ProductsUtil->getProductStore($product, $store);

		$r1 = $s['ProductStore']['retail_level_1'];
		$r2 = $s['ProductStore']['retail_level_2'];
		$r3 = $s['ProductStore']['retail_level_3'];
		
		$d1 = $s['ProductStore']['discount_level_1'];
		$d2 = $s['ProductStore']['discount_level_2'];
		$d3 = $s['ProductStore']['discount_level_3'];
		
		$q1start = $s['ProductStore']['qty_level_1_start'];
		$q1end = $s['ProductStore']['qty_level_1_end'];
		
		$q2start = $s['ProductStore']['qty_level_2_start'];
		$q2end = $s['ProductStore']['qty_level_2_end'];
		
		$q3start = $s['ProductStore']['qty_level_3_start'];
		$q3end = $s['ProductStore']['qty_level_3_end'];

		$variablePricing = $s['ProductStore']['variable_pricing'];

		// if no retail passed in, check qty set it to retail unless there is a discount
		if ($retail == 0) {
			
			if ( ($q2start > 0 || $q2end > 0) && ($qty >= $q2start && $qty <= $q2end) ) {
				$retail = $d2 > 0 ? $d2 : $r2;
			} else if ( ($q3start > 0 || $q3end > 0) && ($qty >= $q3start && $qty <= $q3end) ) {
				$retail = $d3 > 0 ? $d3 : $r3;
			} else {
				$retail = $d1 > 0 ? $d1 : $r1;
			}
		}

		if ($variablePricing == 1) {

			$a = array($r1, $r2, $r3, $d1, $d2, $d3);

			foreach ($a as $index => $v):
				if ($v == 0)
					unset($a[$index]);
			endforeach;

			$min = min($a);
			$max = max($a);
			$retail = $retail >= $min && $retail <= $max ? $retail : $r1;
			
		} else {
			$retail = $this->__isRetailMatch($retail, $r1) || $this->__isRetailMatch($retail, $r2) || $this->__isRetailMatch($retail, $r3) 
				|| $this->__isRetailMatch($retail, $d1) || $this->__isRetailMatch($retail, $d2) || $this->__isRetailMatch($retail, $d3) ? $retail : $r1;
		}

		return $retail;
	}	
}
?>