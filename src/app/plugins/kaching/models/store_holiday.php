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
 * StoreHoliday Model
 * 
 * @author Mike Friesen
 *
 */
class StoreHoliday extends KachingAppModel {
	
	var $name = 'StoreHoliday';
	var $belongsTo = 'Store'; 
    var $validate = array(
    	'store_id' => array('rule' => 'notEmpty', 'message' => '* Store is required'),
    	'date' => array('rule' => 'notEmpty', 'message' => '* Date is required'));
}

?>