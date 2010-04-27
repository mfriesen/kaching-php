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
 * Region Model
 * 
 * @author Mike Friesen
 *
 */
class Region extends KachingAppModel {
	
	var $name = 'Region';

 	var $validate = array(
				  	'name' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Name is required'),
 					'country_id' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Country is required')
    			);
}
?>