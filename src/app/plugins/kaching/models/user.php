<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.models
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * User Model
 * 
 * @author Mike Friesen
 *
 */
class User extends KachingAppModel {
	
	var $name = 'User';
	
  	var $validate = array(
  		'username' => array('rule' => 'notEmpty', 'message' => '* Username is required'),
  		'password' => array('rule' => 'notEmpty', 'message' => '* Password is required'),
  		'group_id' => array('rule' => 'notEmpty', 'message' => '* Group is required')
    );
}
?>