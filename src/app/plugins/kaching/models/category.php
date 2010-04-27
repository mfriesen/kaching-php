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
 * Category Model
 * 
 * @author Mike Friesen
 *
 */
class Category extends KachingAppModel
{
	var $name = 'Category';
	var $recursive = -1;
	var $actsAs = array('Tree');

	var $hasAndBelongsToMany = array(
	'Product' =>
		array( 	'className' => 'Product',
				'joinTable' => 'product_categories',
				'foreignKey' => 'category_id',
				'associationForeignKey' => 'product_id',
				'order' => 'Category.name',
				'unique' => true
			 )
	);
	
 	var $validate = array(
				  	'name' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Name is required')
    			);
}

?>
