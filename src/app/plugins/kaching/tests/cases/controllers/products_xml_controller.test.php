<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.tests.cases.controllers
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::import('Controller', 'Kaching.ProductsXml');

/**
 * Products Xml Controller Tests
 * 
 * @author Mike Friesen
 *
 */
class ProductsXmlControllerTest extends CakeTestCase {
	
	var $dropTables = false;
	var $fixtures = array('plugin.kaching.product');
	 
	function startCase() {
	}
	
	function endCase() {
	}
	
	function startTest($method) {		
	}
	
	function endTest($method) {
		echo '<hr />'; 
	}
	
	function testXmlData() {

		$data = array('User' => array("username" => "admin", "password" => "admin"));
		$result = $this->testAction('/kaching/products_xml/view/10001', array('fixturize' => true, 'data' => $data, 'method' => 'post'));

		$this->assertTrue(count($result) == 3);
		$this->assertTrue($result['Product']['number'] == 1);
		$this->assertTrue($result['Product']['title'] == "Test Product #1");
		//$this->assertTrue(count($result['ProductStore']) == 1);
		//$this->assertTrue(count($result['Category']) == 1);
	}
	
	function testXmlLoginOk() {

		$data = array('User' => array("username" => "admin", "password" => "admin"));
		$result = $this->testAction('/kaching/products_xml/view/10001', array('fixturize' => true, 'data' => $data, 'method' => 'post', "return" => "contents"));

		$t = '<kaching><product id="10001" number="1" title="Test Product #1" weight="0" description="Test Product #1 Sample" keywords="" thumbnail="" image="" page="" inserted_date="0000-00-00 00:00:00" modified_date="0000-00-00 00:00:00"><product_store /><category /></product></kaching>';
		$this->assertTrue(strpos($result, $t) > 0);
	}
	
	function testXmlLoginInvalid() {

		$data = array('User' => array("username" => "test2", "password" => "test2"));
		$result = $this->testAction('/kaching/products_xml/view/10001', array('fixturize' => true, 'data' => $data, 'method' => 'post', "return" => "contents"));
		
		$this->assertTrue(strpos($result, '<kaching><error>Invalid Login Credentials</error></kaching>') > 0);
	}
	
	function testNoLogin() {

		$data = array();
		$result = $this->testAction('/kaching/products_xml/view/1', array('fixturize' => true, 'data' => $data, 'method' => 'post', "return" => "contents"));
		
		$this->assertTrue(strpos($result, '<kaching><error>Invalid Login Credentials</error></kaching>') > 0);
	}
	
	function testSaveLogin() {

		$data = array();
		$result = $this->testAction('/kaching/products_xml/save', array('fixturize' => true, 'data' => $data, 'method' => 'post', "return" => "contents"));
		
		$this->assertTrue(strpos($result, '<kaching><error>Invalid Login Credentials</error></kaching>') > 0);
	}
	
	function testSaveWithErrors() {
		
		$data = array('User' => array("username" => "admin", "password" => "admin"));
		$result = $this->testAction('/kaching/products_xml/save', array('fixturize' => true, 'data' => $data, 'method' => 'post', "return" => "contents"));

		$t = "<kaching><error><field>number</field><message>* Number is required</message></error><error><field>title</field><message>* Title is required</message></error><error><field>weight</field><message>* Weight is required.</message></error><error><field>page</field><message>* Page is already been used</message></error></kaching>";
		$this->assertTrue(strpos($result, $t) > 0);		
	}

	function testSearchNoLogin() {

		$data = array();
		$result = $this->testAction('/kaching/products_xml/search', array('fixturize' => true, 'data' => $data, 'method' => 'post', "return" => "contents"));
		
		$this->assertTrue(strpos($result, '<kaching><error>Invalid Login Credentials</error></kaching>') > 0);
	}

	function testXmlSearch() {

		$data = array('User' => array("username" => "admin", "password" => "admin"));
		$result = $this->testAction('/kaching/products_xml/search', array('fixturize' => true, 'data' => $data, 'method' => 'post', "return" => "contents"));

		$t = '<kaching><product id="10001" number="1" title="Test Product #1" weight="0" description="Test Product #1 Sample" keywords="" thumbnail="" image="" page="" inserted_date="0000-00-00 00:00:00" modified_date="0000-00-00 00:00:00" /><product id="10002" number="2" title="Test Product #2" weight="0" description="Test Product #2 Sample" keywords="" thumbnail="" image="" page="" inserted_date="0000-00-00 00:00:00" modified_date="0000-00-00 00:00:00" /></kaching>';
		$this->assertTrue(strpos($result, $t) > 0);
	}
}
?>