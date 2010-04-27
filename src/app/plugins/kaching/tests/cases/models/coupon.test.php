<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.tests.cases.models
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::import('Model','Kaching.Coupon');

/**
 * Coupons Model Tests
 * 
 * @author Mike Friesen
 *
 */
class CouponTestCase extends CakeTestCase {
	
	var $fixtures = array('plugin.kaching.coupon');
	
	var $coupon = array("Coupon"=>array("title"=>"test", "store_id"=>1, "percent"=>0, "shipping_percent"=>0, 
		"amount"=>0, "start"=>"2000-01-01", "end"=>"2050-01-01", "code"=>"asd"));

	function testEmptyStore() {
		
		$this->Coupon =& ClassRegistry::init('Coupon');
				
		$this->Coupon->set(array());
		
		$this->assertFalse($this->Coupon->validates());
		$errors = $this->Coupon->invalidFields();
		
		$this->assertEqual(count($errors), 8, "Number of errors is wrong");
		
		$this->assertEqual($errors['title'], "* Title is required", $errors['title']);
		$this->assertEqual($errors['store_id'], "* Store is required", $errors['store_id']);
		$this->assertEqual($errors['percent'], "* Percent Discount is required", $errors['percent']);
		$this->assertEqual($errors['shipping_percent'], "* Shipping Percent is required", $errors['shipping_percent']);
		$this->assertEqual($errors['amount'], "* Amount is required", $errors['amount']);
		$this->assertEqual($errors['start'], "* Start Date is required", $errors['start']);
		$this->assertEqual($errors['end'], "* End Date is required", $errors['end']);
		$this->assertEqual($errors['code'], "* Code is required", $errors['code']);
	}
	
	function testPercentOrAmount() {
		
		$this->Coupon->set($this->coupon);
		$this->assertFalse($this->Coupon->validates());
		$errors = $this->Coupon->invalidFields();
		$this->assertEqual(count($errors), 1, "Number of errors is wrong");
		$this->assertEqual($errors['percent'], "* Percent or Amount is required", $errors['percent']);
	}
	
	function testIsActive() {
		$result = $this->Coupon->isActive(1, "10percent");
		$this->assertTrue($result);

		$result = $this->Coupon->isActive(2, "10percent");
		$this->assertFalse($result);
		
		$result = $this->Coupon->isActive(1, "asd");
		$this->assertFalse($result);
	}
	
	function testFindByStoreAndCode() {
		$result = $this->Coupon->findByStoreAndCode(1, "10percent");
		$this->assertFalse(empty($result));
		
		$result = $this->Coupon->findByStoreAndCode(2, "10percent");
		$this->assertTrue(empty($result));
		
		$result = $this->Coupon->findByStoreAndCode(1, "asd");
		$this->assertTrue(empty($result));
		
	}
}
?>