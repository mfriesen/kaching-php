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
 * Orderstats controller
 * 
 * This class display stats about orders
 *    
 * @author Mike Friesen
 *
 */
require_once("admin_controller.php");

class OrderstatsController extends AdminController 
{	
	var $name = 'Orderstat';
	var $viewPath = 'order';
	var $components = array('Auth', 'Kaching.ControllerUtil');
	var $helpers = array('Html', 'Javascript', 'Kaching.Date');
	var $uses = array('Kaching.Ordersearch', 'Kaching.Order', 'Kaching.Product', 'Kaching.Store');
	
	var $paginate = array('Order' => array('limit' => 10, 'order' => array('Order.inserted_date' => 'asc')));
	
    function index() {
    	
        if (!empty($this->data)) {
        	$start = strlen($this->data['Ordersearch']['startdate']) > 0 ? $this->data['Ordersearch']['startdate'] : "";
        	$end = strlen($this->data['Ordersearch']['enddate']) > 0 ? $this->data['Ordersearch']['enddate'] : "";
        	
			$this->Ordersearch->set($this->data);
	        $this->Ordersearch->validates();
        }

        if (isset($start) && strlen($start) > 0) {

        	$list = $this->Order->getMostPopularProductIds($start, $end);
        	//debug($list);
        	$this->set('list', $list);
        	
        	$stores = array();
        	$products = array();
        	
        	foreach($list as $item):
        	
        		$storeId = $item['Order']['store_id'];
        		$productId = $item['OrderDetail']['product_id'];
        		
        		if (!array_key_exists($storeId, $stores)) {
        			$stores[$storeId] = $this->Store->findById($storeId);
        		}
        		
        		$products[$productId] = $this->Product->findById($productId);
        	
        	endforeach;
        	
        	$this->set('stores', $stores);
        	$this->set('products', $products);     	
        }
        
        $this->render("stats");
    }
}
?>