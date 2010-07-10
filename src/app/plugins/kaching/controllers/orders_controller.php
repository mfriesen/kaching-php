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
 * Groups controller
 * 
 * This class controls the maintenance of the orders.
 *    
 * @author Mike Friesen
 *
 */
require_once("admin_controller.php");

class OrdersController extends AdminController {
	
	var $name = 'Order';
	var $viewPath = "order";
	var $components = array('Auth', 'Kaching.ControllerUtil', 'Kaching.Paypal', 'Kaching.ProductsUtil');
	var $uses = array('Kaching.Order', 'Kaching.Product', 'Kaching.ProductStore', 'Kaching.Store');
	var $helpers = array('Ajax', 'Html', 'Javascript', 'Kaching.Date', 'Kaching.OrderUtil', 'Kaching.Cart');
	
	function index() {
		
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'ordersearches', 'action' => "search"));
	}
	
    function view($id) {
    	
        $order = $this->Order->findById($id);
        
        $storeId = $order['Order']['store_id'];
        $store = $this->Store->findById($storeId);
        $this->set('store', $store);
        
        foreach($order['OrderDetail'] as $count => $detail) {
        	
            $productId = $detail['product_id'];
           
            $this->Product->recursive = -1;
        	$product = $this->Product->findById($productId);
			$productstore = $this->ProductsUtil->getProductStore($product, $store);

        	$detail = array_merge($detail, $product);
        	$detail = array_merge($detail, $productstore);
        	$order['OrderDetail'][$count] = $detail;
        }
        
        $this->data = $order;
        $this->set('order', $order);
    }
    
    function printview($id) {
    	
    	$this->view($id);
    	$this->render('view', 'print');
    }

    function cancel($id) {
    	
    	$order = $this->Order->findById($id);
    	$order['Order']['modified_date'] = date("Y-m-d G:i:s", time());
    	$order['Order']['status'] = $this->Order->cancelStatus;
    	
    	$this->Order->save($order, array('validate' => false));
    	$this->redirect(array('plugin' => 'kaching', 'controller' => 'orders', 'action' => "view/$id"));
    }
    
    function complete($id) {
    	
    	$order = $this->Order->findById($id);
    	$order['Order']['modified_date'] = date("Y-m-d G:i:s", time());
    	$order['Order']['status'] = $this->Order->completedStatus;
    	$order['Order']['credit_card_number'] = "";
    	$order['Order']['credit_card_expiry'] = "";
    	
    	$this->Order->save($order, array('validate' => false));
    	$this->redirect(array('plugin' => 'kaching', 'controller' => 'orders', 'action' => "view/$id"));
    }
    
    function completeKeepCreditCard($id) {
    	
    	$order = $this->Order->findById($id);
    	$order['Order']['modified_date'] = date("Y-m-d G:i:s", time());
    	$order['Order']['status'] = $this->Order->completedStatus;
    	
    	$this->Order->save($order, array('validate' => false));
    	$this->redirect(array('plugin' => 'kaching', 'controller' => 'orders', 'action' => "view/$id"));
    }
    
    function paypalPayment($id) {
    	
    	$order = $this->Order->findById($id);
    	
    	$storeId = $order['Order']['store_id'];
        $store = $this->Store->findById($storeId);

        $this->Paypal->doSalePayment($order, $store);
        
        $order['Order']['modified_date'] = date("Y-m-d G:i:s", time());
		$this->Order->save($order, array('validate' => false));
	        
        $this->redirect(array('plugin' => 'kaching', 'controller' => 'orders', 'action' => "view/$id"));
    }
    
    function paypalRefund($id) {
    	
    	$order = $this->Order->findById($id);

    	$storeId = $order['Order']['store_id'];
        $store = $this->Store->findById($storeId);
        
    	$this->Paypal->doRefund($order, $store);
    	$order['Order']['modified_date'] = date("Y-m-d G:i:s", time());
		$this->Order->save($order, array('validate' => false));
	        
        $this->redirect(array('plugin' => 'kaching', 'controller' => 'orders', 'action' => "view/$id"));
    }
}
?>