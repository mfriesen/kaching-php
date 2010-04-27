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

App::import('Model', 'Kaching.Coupon');

/**
 * Coupon Fixture
 * 
 * @author Mike Friesen
 *
 */
class CouponFixture extends CakeTestFixture {

	var $name = 'Coupon';
	var $import = array('model' => 'Coupon'); 
	var $records = array( 
		array("title"=>"test", "store_id"=>1, "percent"=>0, "shipping_percent"=>0, "amount"=>0, "min_amount"=>0, "start"=>"2000-01-01", "end"=>"2050-01-01", "code"=>"test"),
		array("title"=>"10percent", "store_id"=>1, "percent"=>10, "shipping_percent"=>0, "amount"=>0, "min_amount"=>20, "start"=>"2000-01-01", "end"=>"2050-01-01", "code"=>"10percent"),
		);
}
?>
