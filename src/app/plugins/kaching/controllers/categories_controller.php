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
 * Categories controller
 * 
 * This class controls the maintenance of categories from the kaching administration pages
 *    
 * @author Mike Friesen
 *
 */
require_once("admin_controller.php");

class CategoriesController extends AdminController {
		
	var $name = 'Category';
	var $plugin = 'kaching';
	var $components = array('Auth', 'RequestHandler', 'Kaching.ControllerUtil');
	var $viewPath = "category";
	
	var $helpers = array('Html','Javascript', 'Ajax');

	var $paginate = array('Category' => array(0=>'threaded', 'limit' => 20, 'order' => array('name' => 'asc')));
	
    function index() {

		$categories = $this->paginate('Category');
		$this->set(compact("categories"));		
    	
		if (isset($this->params['requested'])) {
			return $categories;
		} 
	}
	
	function delete($id) {
		$this->Category->delete($id);			
	}
	
	function edit($id=null) {
		
		if (!empty($this->data)) {
			
			if ($this->Category->save($this->data)) {
				$this->flash('Category has been saved.', 'index');
			}
		}
		
		if ($id != null && is_numeric($id))
		{
			$category = $this->Category->findById($id);
        	$this->data = $category;
		}

		if (isset($this->params['requested'])) {
			return $this->data;
		} 
		
		$categories = $this->Category->find("list", array('order' => array('name' => 'asc')));
		$this->set(compact("categories"));
	}	
}
?>