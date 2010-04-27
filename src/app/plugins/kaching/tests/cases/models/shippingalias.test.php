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

App::import('Model','Kaching.Shippingalias');

/**
 * Shippingalias Model Tests
 * 
 * @author Mike Friesen
 *
 */
class ShippingaliasTestCase extends CakeTestCase {
	
//	var $dropTables = false;

	function testEmptyStore() {
		
		$this->Shippingalias =& ClassRegistry::init('Shippingalias');
				
		$this->Shippingalias->set(array());
		
		$this->assertFalse($this->Shippingalias->validates());
		$errors = $this->Shippingalias->invalidFields();

		$this->assertEqual(count($errors), 3, "Number of errors is wrong");
		$this->assertEqual($errors['shippingzone_id'], "* Shipping Id is required", $errors['shippingzone_id']);
		$this->assertEqual($errors['region'], "* Region is required", $errors['region']);
		$this->assertEqual($errors['country'], "* Country is required", $errors['country']);
	}
	
	function testOkayProvince() {
		$this->Shippingalias->set(array("Shippingalias"=>array("shippingzone_id"=>1, "country"=>"CA", "region"=>"MB")));
		$errors = $this->Shippingalias->invalidFields();
		$this->assertTrue($this->Shippingalias->validates());
	}
	
	function testInvalidCanadaPostalCode() {
		$this->Shippingalias->set(array("Shippingalias"=>array("shippingzone_id"=>1, "country"=>"CA", "postalcode"=>"R3R2", "region"=>"MB")));
		
		$this->assertFalse($this->Shippingalias->validates());
		$errors = $this->Shippingalias->invalidFields();
		
		$this->assertEqual(count($errors), 1, "Number of errors is wrong");
		$this->assertEqual($errors['postalcode'], "* Only first 3 Postal Code characters is required", $errors['postalcode']);
	}
	
	function testValidCanadaPostalCode() {
		$this->Shippingalias->set(array("Shippingalias"=>array("shippingzone_id"=>1, "country"=>"CA", "postalcode"=>"R3R", "region"=>"MB")));
		$this->assertTrue($this->Shippingalias->validates());
	}
}
?>