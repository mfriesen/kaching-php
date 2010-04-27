<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.controllers.components
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Xml Webservice component
 * 
 * This class contains Xml Webservice helper methods 
 *    
 * @author Mike Friesen
 *
 */
class XmlWebserviceComponent extends Object {
	
	function startup( &$controller ) {
		$this->controller = &$controller;
	}

	/**
	 * Renders the xml view
	 */
	function render() {
		
	    //$this->controller->RequestHandler->respondAs('xml');
		$this->controller->viewPath .= '/xml';
		$this->controller->layoutPath = 'xml';
		$this->controller->layout = "iphone";
		$this->controller->render("iphone");	
	}
	
	/**
	 * Returns whether login information is correct
	 * @param $d
	 */
    function isValidUser($d) {
    	
    	$user = isset($d['User']['username']) ? $d['User']['username'] : "";
    	$pass = isset($d['User']['password']) ? $d['User']['password'] : ""; 
    	$data = array("username"=>$user, "password"=>$pass);

		if ($this->controller->Auth->login($data)) {
			return true;
		} 
		
		$this->controller->set("error", "Invalid Login Credentials");
		return false;
    }
}
?>