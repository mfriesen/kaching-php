<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.tests.fixtures
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::import('Model', 'Kaching.Product');

/**
 * Product Fixture
 * 
 * @author Mike Friesen
 *
 */
class ProductFixture extends CakeTestFixture {

	var $name = 'Product';
	var $import = array('model' => 'Product', 'records' => false); 
	var $records = array( 
							array('id' => 10001, 'number' => '1', 'title' => 'Test Product #1', 'description'=>'Test Product #1 Sample'),
							array('id' => 10002, 'number' => '2', 'title' => 'Test Product #2', 'description'=>'Test Product #2 Sample')
						 );
}
?>