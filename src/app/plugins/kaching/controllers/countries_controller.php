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

require_once("admin_controller.php");

/**
 * Countries controller
 * 
 * This class controls the maintenance of the Shipping countries.
 *    
 * @author Mike Friesen
 *
 */
class CountriesController extends AdminController {
	
	var $name = 'Countries';
	var $viewPath = "country";
	var $components = array('Auth', 'RequestHandler', 'Kaching.ControllerUtil');	
	var $helpers = array('Html','Javascript', 'Ajax');
	var $paginate = array('Country' => array('limit' => 20, 'order' => array('name' => 'asc')));
	
	/**
	 * Display the countries
	 */
	function index() {		
		$this->Country->recursive = 1;
		$this->data = $this->paginate('Country');
	}
	
	/**
	 * Edits a country
	 * @param $id
	 */
	function edit($id=null) {
		
		if (!empty($this->data)) {

			$id = $this->data['Country']['id'];
			
			if ($this->Country->save($this->data)) {
				$this->flash('Country has been saved.', "edit/$id");
			}
		}
		
		if ($id != null) {
			$this->data = $this->Country->findById($id);
		}
	}
	
	/**
	 * Deletes shipping alias
	 * @param $id
	 */
	function delete($id) {
		$this->Country->del($id);
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'countries', 'action' => "index"));
	}
}
?>