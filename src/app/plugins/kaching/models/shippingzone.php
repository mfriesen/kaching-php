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
 * Shippingzone Model
 * 
 * @author Mike Friesen
 *
 */
class Shippingzone extends KachingAppModel {
	
	var $name = 'Shippingzone';
	var $recursive = -1;
		
	var $hasMany = array(
		'Shippingamount' => array('className' => 'Kaching.Shippingamount', 'order' => 'weight'),
		'Shippingalias' => array('className' => 'Kaching.Shippingalias', 'order' => 'country')
	);

	var $hasAndBelongsToMany = array(
		'Store' =>
			array( 	'className' => 'Kaching.Store',
					'joinTable' => 'store_shippingzones',
					'foreignKey' => 'shippingzone_id',
					'associationForeignKey' => 'store_id',
					'unique' => false
				 )
	);
	
 	var $validate = array(
				  	'label' => array('rule' => 'notEmpty', 'message' => '* Zone Label is required')
    			);
}
?>