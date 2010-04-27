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

App::import('Model','Kaching.Store');

/**
 * Store Model Tests
 * 
 * @author Mike Friesen
 *
 */
class StoreTestCase extends CakeTestCase {
	
//	var $dropTables = false;
	var $fixtures = array('plugin.kaching.store');
	
	var $store = array("Store"=>array("number"=>2, "name"=>"test", "website"=>"test", "email"=>"asd@here.com", 
		"tax1"=>7, "tax2"=>5, "tax1name"=>"PST", "tax2name"=>"GST", "shipping_tax"=>10, "service_fee"=>20, 
		"payment_process"=>0, "currency"=>"CDN"));
		
	function testEmptyStore() {
		
		$this->Store =& ClassRegistry::init('Store');
				
		$this->Store->set(array());
		
		$this->assertFalse($this->Store->validates());
		$errors = $this->Store->invalidFields();
		
		$this->assertEqual(count($errors), 12, "Number of errors is wrong");
		$this->assertEqual($errors['number'], "* Number is required", $errors['number']);
		$this->assertEqual($errors['name'], "* Name is required", $errors['name']);
		$this->assertEqual($errors['website'], "* Website is required", $errors['website']);
		$this->assertEqual($errors['email'], "* Email is required", $errors['email']);
		$this->assertEqual($errors['tax1'], "* Tax1 is required", $errors['tax1']);
		$this->assertEqual($errors['tax2'], "* Tax2 is required", $errors['tax2']);
		$this->assertEqual($errors['shipping_tax'], "* Shipping Tax is required", $errors['shipping_tax']);
		$this->assertEqual($errors['tax1name'], "* Tax1 Name is required", $errors['tax1name']);
		$this->assertEqual($errors['tax2name'], "* Tax2 Name is required", $errors['tax2name']);
		$this->assertEqual($errors['service_fee'], "* Service Fee is required", $errors['service_fee']);
		$this->assertEqual($errors['payment_process'], "* Payment Process is required", $errors['payment_process']);
		$this->assertEqual($errors['currency'], "* Currency is required", $errors['currency']);
	}
	
	function testOkay() {
		$this->Store->set($this->store);
		$this->assertTrue($this->Store->validates());
	}
	
	function testMustBeStore1() {

		$this->_fixtures["plugin.kaching.store"]->truncate($this->db);
		$this->store['Store']['number'] = 2;
		$this->Store->set($this->store);
		$this->assertFalse($this->Store->validates());
		
		$errors = $this->Store->invalidFields();
		$this->assertEqual(count($errors), 1, "Number of errors is wrong");
		$this->assertEqual($errors['number'], "* Number must be 1", $errors['number']);
	}

	function testStoreNumberExists() {

		$this->store['Store']['number'] = 1;
		$this->Store->set($this->store);
		$this->assertFalse($this->Store->validates());
		
		$errors = $this->Store->invalidFields();
		$this->assertEqual(count($errors), 1, "Number of errors is wrong");
		$this->assertEqual($errors['number'], "* Store Number already exists", $errors['number']);
	}
	
	function testTaxNameNeededIfRateExists() {

		$this->store['Store']['number'] = 2;
		$this->store['Store']['tax1'] = 1;
		$this->store['Store']['tax2'] = 2;
		$this->Store->set($this->store);
		$this->assertFalse($this->Store->validates());
		
		$errors = $this->Store->invalidFields();
		$this->assertEqual(count($errors), 2, "Number of errors is wrong");
		$this->assertEqual($errors['tax1name'], "* Tax1 Name is required", $errors['tax1name']);
		$this->assertEqual($errors['tax2name'], "* Tax2 Name is required", $errors['tax2name']);
	}
}

?>