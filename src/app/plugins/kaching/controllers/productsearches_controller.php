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
 * Productsearches controller
 * 
 * This class controls the searching for products
 *    
 * @author Mike Friesen
 *
 */
require_once("admin_controller.php");

class ProductsearchesController extends AdminController {
	
	var $name = 'Productsearch';
	var $viewPath = 'product';
	var $components = array('Auth', 'RequestHandler', 'Kaching.ControllerUtil');
	var $helpers = array('Html', 'Javascript', 'Kaching.Date', 'Kaching.Cart');
	var $uses = array('Kaching.Productsearch', 'Kaching.Product', 'Kaching.Category', 'Kaching.Store');
	
	var $paginate = array('Product' => array('limit' => 10, 'order' => array('number' => 'asc')));
	
    function index() {
    	
    	if ($this->RequestHandler->isPost()) {
			
			$q = isset($this->data['Productsearch']['q']) ? $this->data['Productsearch']['q'] : "";
			$limit = isset($this->data['Productsearch']['limit']) ? $this->data['Productsearch']['limit'] : 10;
			$sort = isset($this->data['Productsearch']['sort']) ? $this->data['Productsearch']['sort'] : "title";
			$direction = isset($this->data['Productsearch']['direction']) ? $this->data['Productsearch']['direction'] : "asc";
			
			$this->redirect("/kaching/productsearches/index/q:$q/limit:$limit/sort:$sort/direction:$direction");
		}

		if (count($this->passedArgs) == 0) {
			$this->data = array();
		} else {
			
			$q = isset($this->passedArgs['q']) ? $this->passedArgs['q'] : "";
			$sort = isset($this->passedArgs['sort']) ? $this->passedArgs['sort'] : "title";
			$direction = isset($this->passedArgs['direction']) ? $this->passedArgs['direction'] : "asc";
		        
	        $qq = "%$q%";
			$conditions = array("or"=>array("number like"=>$qq, "title like"=>$qq));
        	$this->data['products'] = $this->paginate('Product', $conditions);

        	$this->data['Productsearch']['q'] = $q;
	        $this->data['Productsearch']['sort'] = $sort;
	        $this->data['Productsearch']['direction'] = $direction;
        	
        	$this->set('stores', $this->Store->find('list'));
		}
    }	
}
?>