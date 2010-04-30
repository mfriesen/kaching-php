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
 * Ordersearch Model
 * 
 * @author Mike Friesen
 *
 */
class Ordersearch extends KachingAppModel {
    var $name = 'Ordersearch';
    var $useTable = false;

	var $validate = array('startdate' => 
							array(
									array(	'rule' => 'date', 'message' => 'Enter a valid start date in YYYY-MM-DD format.', 'allowEmpty' => false)
								 )
						 );
}
?>