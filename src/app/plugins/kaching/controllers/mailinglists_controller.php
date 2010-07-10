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
 * Mailinglists controller
 * 
 * This class controls the maintenance of the mailinglist.
 *    
 * @author Mike Friesen
 *
 */
require_once('recaptchalib.php');
require_once("admin_controller.php");

class MailinglistsController extends AdminController 
{	
	var $name = 'Mailinglist';
	var $viewPath = "mailinglist";
	var $components = array('Auth', 'RequestHandler', 'Kaching.ControllerUtil');
	var $helpers = array('Html','Javascript', 'Ajax');
	var $paginate = array('Mailinglist' => array('limit' => 10, 'order' => array('email' => 'asc')));
	
    function index($q=null)
    {
    	if (!empty($this->data)) {
			$q = isset($this->data['Mailinglist']['q']) ? $this->data['Mailinglist']['q'] : "";
    	}
    	
        if ($q != null && strlen($q) > 0)
        {
        	$this->data['Mailinglist']['q'] = $q;
        	$conditions = array("email like '%$q%'"); 
			$this->data = $this->paginate('Mailinglist', $conditions);
        }
        else
        {		
    		$this->data = $this->paginate('Mailinglist');
        }
    	    	
    	if (isset($this->params['requested'])) {
			return $this->data;
		}
    }
    
	function edit($id=null) {
		
		if (!empty($this->data)) {
			$this->data['Mailinglist']['code'] = substr(preg_replace('/[\/\\\:*?"<>|.$^1]/', '', crypt(time())), 0, 16);
			if ($this->Mailinglist->save($this->data)) {
				$this->flash('Email has been saved.', 'index');
			}
		}
		
		if ($id != null && is_numeric($id)) {
			
			$mailinglist = $this->Mailinglist->findById($id);
        	$this->data = $mailinglist;
		}

		if (isset($this->params['requested'])) {
			return $this->data;
		} 
	}
	
	function delete($id=null)
	{
		if ($id != null && is_numeric($id)) {
			$this->Mailinglist->delete($id);
		}
		
		if (!isset($this->params['requested'])) {
			$this->redirect(array('plugin' => 'kaching', 'controller' => 'mailinglists', 'action' => "index"));
		}
	}	
}
?>