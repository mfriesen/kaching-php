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

App::import('Model', 'Kaching.Category');

/**
 * Category Fixture
 * 
 * @author Mike Friesen
 *
 */
class CategoryFixture extends CakeTestFixture {

	var $name = 'Category';
	var $import = array('model' => 'Category'); 
	var $records = array( 
							array('id' => 1, 'name' => 'Congratulations'),
							array('id' => 2, 'name' => 'Birthday'),
						 );
}
?>
