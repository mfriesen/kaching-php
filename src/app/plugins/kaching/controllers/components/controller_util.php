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
 * ControllerUtil component
 * 
 * This class contains controller helper methods
 *    
 * @author Mike Friesen
 *
 */

class ControllerUtilComponent extends Object {

	function initialize(&$controller, $settings=array()) {
		$this->controller = &$controller;
	}
	
	/**
	 * Forces a page NOT to be SSL
	 */
	function forceNonSsl() {

		if (env("HTTPS")) {
			$this->controller->redirect('http://' . $_SERVER['SERVER_NAME'] . $this->controller->here);
		}
	}
	
	/**
	 * Forces page to be SSL
	 */
	function forceSsl() {

		$cvalue = Configure::read("kaching.admin.ssl");
		if ($cvalue == null || $cvalue == "true") {
			if (!env("HTTPS")) {
				$this->controller->redirect('https://' . $_SERVER['SERVER_NAME'] . $this->controller->here);
			}
		}		
	}
	
	/**
	 * Forces controller to administrator
	 */
	function forceAdminLogin() {
		$this->controller->Auth->loginAction = array('plugin' => 'kaching', 'controller' => 'users', 'action' => 'login');
		$this->controller->Auth->loginRedirect = array('plugin' => 'kaching', 'controller' => 'users', 'action' => 'index');
		$this->controller->Auth->logoutRedirect = '/';
		$this->controller->Auth->autoRedirect = false;
			 
		// Controller autorization is the simplest form.
		$this->controller->Auth->authorize = 'controller';
			
		//  Additional criteria for loging.
		$this->controller->Auth->userScope = array('User.active' => 1, 'User.group_id' => 1); //user needs to be active and part of administrator group.
	}
}
?>