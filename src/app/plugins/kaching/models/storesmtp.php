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
 * Storesmtp Model
 * 
 * @author Mike Friesen
 *
 */
class Storesmtp extends KachingAppModel {
	
	var $name = 'Storesmtp';
	
 	var $validate = array(
 					'smtp_server' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Server required'),
				  	'smtp_port' => array( 
 						array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Port is required'),
 						array('rule' => 'numeric', 'message' => '* Number required'),
 					),
				    'smtp_username' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Username is required'),
 					'smtp_password' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Password is required.'),
    			);
}
?>