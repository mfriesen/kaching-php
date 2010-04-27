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
 * Admin controller
 * 
 * All Kaching Administration controllers extend this controller
 *    
 * @author Mike Friesen
 *
 */
class AdminController extends KachingAppController {
	
	var $layout = 'admin';
		
	function beforeFilter() {
		
		parent::beforeFilter();
		
		$this->ControllerUtil->forceSsl();
		
		$this->ControllerUtil->forceAdminLogin();
		
		if ($this->Auth->user()) {
			$this->set("user", $this->Session->read($this->Auth->sessionKey));
		}
	}
		
	function isAuthorized() {
		return true;
   	}
   	
	function help($page = null) {
		$this->layout = "blank";
		
		if ($page != null) {
			$this->render($page);
		}
	}
}
?>