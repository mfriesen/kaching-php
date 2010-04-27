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

App::import('Model', 'Kaching.Store');

/**
 * Store Fixture
 * 
 * @author Mike Friesen
 *
 */
class StoreFixture extends CakeTestFixture {

	var $name = 'Store';
	var $import = array('model' => 'Store', 'records' => false); 
	var $records = array( 
						array("number"=>1, "name"=>"test", "website"=>"test", "email"=>"asd@here.com", 
						"tax1"=>0, "tax2"=>0, "shipping_tax"=>0, "service_fee"=>0, "payment_process"=>0, "currency"=>"CDN")
						 );
}
?>
