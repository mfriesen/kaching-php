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
 * Views controller
 * 
 * This class contains Views Helper methods
 *    
 * @author Mike Friesen
 *
 */
class ViewsController extends KachingAppController
{
	var $name = 'View';
	var $viewPath = 'pages';
	var $uses = array();
	var $helpers = array('Session', 'Html', 'Javascript');
		
	function view($path, $layout = 'default')
	{
		$this->set('title', ucfirst($path));
		$this->render($path, $layout);
	}
	
	function sendRedirect($url) {
		$this->redirect($url);
	}
}
?>