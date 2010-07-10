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
 * Regions controller
 * 
 * This class controls the maintenance of the Shipping regions.
 *    
 * @author Mike Friesen
 *
 */
class RegionsController extends AdminController {
	
	var $name = 'Regions';
	var $viewPath = "region";
	var $components = array('Auth', 'RequestHandler', 'Kaching.ControllerUtil');	
	var $helpers = array('Html','Javascript', 'Ajax');
	var $uses = array("Kaching.Country", "Kaching.Region");
	
	/**
	 * Display the regions
	 */
	function index($country_id) {
		$this->Country->recursive = 1;		
		$this->data = $this->Country->findById($country_id);
	}
	
	/**
	 * Edits a country
	 * @param $id
	 */
	function edit($country_id=null, $id=null) {
		
		if (!empty($this->data)) {

			$country_id = $this->data['Region']['country_id'];
			
			if ($this->Region->save($this->data)) {
				$this->redirect(array('plugin' => 'kaching', 'controller' => 'regions', 'action' => "index/$country_id"));
			}
		}
		
		if ($country_id != null) {
			$country = $this->Country->findById($country_id);
			$this->set("country", $country);
			$this->data['Region']['country_id'] = $country['Country']['id'];
		}
		
		if ($id != null) {
			$this->data = $this->Region->findById($id);
		}
	}
	
	/**
	 * Deletes shipping region
	 * @param $id
	 */
	function delete($id) {
		
		$this->data = $this->Region->findById($id);
		$country_id = $this->data['Region']['country_id'];
		
		$this->Region->delete($id);
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'regions', 'action' => "index/$country_id"));
	}
}
?>