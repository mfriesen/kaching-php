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
 * Ordersearches controller
 * 
 * This class controls the searching for orders
 *    
 * @author Mike Friesen
 *
 */
require_once("admin_controller.php");

class OrdersearchesController extends AdminController 
{	
	var $name = 'Ordersearch';
	var $viewPath = 'order';
	var $components = array('Kaching.ControllerUtil', 'Auth');
	var $helpers = array('Html', 'Javascript', 'Date', 'OrderUtil');
	var $uses = array('Kaching.Ordersearch', 'Kaching.Order');
	
	var $paginate = array('Order' => array('limit' => 10, 'order' => array('Order.inserted_date' => 'asc')));
	
    function index() {
    	
        if (!empty($this->data)) {
        	$start = strlen($this->data['Ordersearch']['startdate']) > 0 ? $this->data['Ordersearch']['startdate'] : "";
        	$end = strlen($this->data['Ordersearch']['enddate']) > 0 ? $this->data['Ordersearch']['enddate'] : "";
        }

        if (isset($start) && strlen($start) > 0) {
        	
        	$conditions = array('Order.inserted_date >= ?' => array($start));
    	
	    	if (strlen($end) > 0) {
	            $conditions = array('Order.inserted_date BETWEEN ? AND ?' => array($start, $end));
	    	}
        
	        $this->Ordersearch->set($this->data);
	        if ($this->Ordersearch->validates()) {
				$orders = $this->paginate('Order', $conditions);
	        	$this->set('orders', $orders);
			}        	
        } else {
        	
        	$conditions = array('Order.status'=>array(0, 2));
        	$orders = $this->paginate('Order', $conditions);
        	$this->set('orders', $orders);
        }
        $this->render('search');
    }
}
?>