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
 * Product Model
 * 
 * @author Mike Friesen
 *
 */
class Product extends KachingAppModel {
	
	var $name = 'Product';

	var $hasAndBelongsToMany = array(
		'Category' =>
			array( 	'className' => 'Kaching.Category',
					'joinTable' => 'product_categories',
					'foreignKey' => 'product_id',
					'associationForeignKey' => 'category_id',
					'order' => 'Category.name',
					'unique' => true
				 )
	);
	
	var $hasMany = array('Kaching.ProductStore');
		 
 	var $validate = array(
					  	'number' => array( 
 							array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Number is required'),
 							array('rule' => 'isUnique', 'message' => '* Number already used'),
 						),
					    'title' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Title is required'),
 						'weight' => array('rule' => 'notEmpty', 'required'=>true, 'message' => '* Weight is required.'),
					    'page' => array('rule' => 'validatePage', 'required'=>true, 'message' => '* Page is already been used')
    				);
    				
	function validatePage($data) {
		
		if (isset($data['page']) && strlen($data['page']) > 0) {
			return $this->isUnique($data);
		}
		
		return true;
	}
}

?>
