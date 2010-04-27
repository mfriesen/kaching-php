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
 * Users controller
 * 
 * This class controls the maintenance of the kaching user.
 *    
 * @author Mike Friesen
 *
 */
require_once("admin_controller.php");

class UsersController extends AdminController {
	
	var $name = 'Users';
	var $uses = array("Kaching.User", "Kaching.Group");
	var $viewPath = "user";
	var $helpers = array('Html', 'Javascript');
	var $components = array('Kaching.ControllerUtil', 'Auth', 'Cookie'); 
	
	var $paginate = array('User' => array('limit' => 20, 'order' => array('username' => 'asc')));
	
	function beforeFilter() {
		$this->Auth->allow('install');
		parent::beforeFilter();	
	}
	
	function index() {
	}
	
	function home() {
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'users', 'action' => "index"));
	}
	
	function login() {
		
		//-- code inside this function will execute only when autoRedirect was set to false (i.e. in a beforeFilter).
		if ($this->Auth->user()) {
			
			if (!empty($this->data)) {
				
				$cookie = array();
				$cookie['username'] = $this->data['User']['username'];
				$cookie['password'] = $this->data['User']['password'];
				$this->Cookie->write('Auth.User', $cookie, true, '+2 weeks');
				unset($this->data['User']['remember_me']);
			}

			$this->redirect($this->Auth->redirect());
		}
					
		if (empty($this->data)) {
			
			$cookie = $this->Cookie->read('Auth.User');
			
			if (!is_null($cookie)) {
				
				if ($this->Auth->login($cookie)) {
					// Clear auth message, just in case we use it.
					$this->Session->del('Message.auth');
					$this->redirect($this->Auth->redirect());
				}
			}
		}
	}

	function changepassword() {

		if (!empty($this->data)) {
			
			$cookie = $this->Cookie->read('Auth.User');
			$username = $cookie['username'];
			
			if ($this->__validateChangePassword($username)) {
				
				$user = $this->User->findByUsername($username);
				$user['User']['password'] = $this->Auth->password($this->data['User']['newpassword1']);
				$this->User->save($user);
				$this->flash('Your password has been changed.', 'index/');
			}			
		}
	}
	
	function __validateChangePassword($username) {
		
		$okay = true;
		if (strlen($this->data['User']['oldpassword']) == 0) {
			$this->User->invalidate("oldpassword", "* Invalid Old Password");
			$okay = false;
		}
		
		if (strlen($this->data['User']['newpassword1']) == 0) {
			$this->User->invalidate("newpassword1", "* Invalid New Password");
			$okay = false;
		}
			
		if (strlen($this->data['User']['newpassword2']) == 0) {
			$this->User->invalidate("newpassword2", "* Invalid New Password");
			$okay = false;
		}
		
		if ($okay && $this->data['User']['newpassword1'] != $this->data['User']['newpassword2']) {
			$this->User->invalidate("newpassword2", "* New Passwords do not match");
			$okay = false;
		}
		
		$conditions = array("User.username = ? and User.password = ?" => array($username, $this->Auth->password($this->data['User']['oldpassword'])));
		if (!$this->User->hasAny($conditions)) {
			$this->User->invalidate("oldpassword", "* Old Password does not match");
			$okay = false;
		}
		
		return $okay;
	}
	
	function logout() {
		
		$cookie = $this->Cookie->del('Auth.User');
        $this->Session->setFlash('Logout');
	    $this->redirect($this->Auth->logout());
    }
    
    function search() {
    	
    	$groups = $this->Group->find("list", array('fields'=> array('id','name'), 'order' => array('name' => 'asc')));
		$this->set(compact("groups"));
    	
    	$this->data = $this->paginate('User');
    }
    
   	function edit($id=null) {

		if (!empty($this->data)) {
			
			$this->User->set($this->data);
			if ($this->User->validates() && $this->__validateUser()) {
				
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['password1']);
				$this->User->save($this->data);
				$this->flash('User has been saved.', 'search');
			}
		}
		
		if ($id != null && is_numeric($id)) {
			$this->data = $this->User->findById($id);
		}

		$groups = $this->Group->find("list", array('fields'=> array('id','name'), 'order' => array('name' => 'asc')));
		$this->set(compact("groups"));
	}
	
	function __validateUser() {
		
		$okay = true;
		
		if (strlen($this->data['User']['password1']) == 0) {
			$this->User->invalidate("password1", "* Password is required");
			$okay = false;
		}
			
		if (strlen($this->data['User']['password2']) == 0) {
			$this->User->invalidate("password2", "* Password is required");
			$okay = false;
		}
		
		if ($okay && $this->data['User']['password1'] != $this->data['User']['password2']) {
			$this->User->invalidate("password2", "* New Passwords do not match");
			$okay = false;
		}
		
		return $okay;
	}
	
	function delete($id=null)
	{
		if ($id != null && is_numeric($id)) {
			$this->User->del($id);
		}
		
		$this->redirect(array('plugin' => 'kaching', 'controller' => 'users', 'action' => "search"));
	}
	
	function install() {
		
		$users = $this->User->find('count');
		if ($users > 0) {
			$this->redirect(array('plugin' => 'kaching', 'controller' => 'users', 'action' => "index")); 	
		}
		
		if (!empty($this->data)) {
			
			$this->User->set($this->data);
			if ($this->User->validates() && $this->__validateUser()) {
				
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['password1']);
				$this->User->save($this->data);
				$this->flash('User has been created.', 'login');
			}
		}

		$groups = $this->Group->find("list", array('fields'=> array('id','name'), 'order' => array('name' => 'asc')));
		
		if (empty($groups)) {
			$this->Group->save(array("Group"=>array("id"=>1, "name"=>"Administrator")));
			$groups = $this->Group->find("list", array('fields'=> array('id','name'), 'order' => array('name' => 'asc')));
		}
		
		$this->set(compact("groups"));
	}
}
?>