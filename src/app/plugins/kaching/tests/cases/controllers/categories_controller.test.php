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

//App::import('Controller', 'Kaching.Categories');

/**
 * Categories Controller Tests
 * 
 * @author Mike Friesen
 *
 */
class CategoriesControllerTest extends CakeTestCase {

	var $fixtures = array('plugin.kaching.category');

	function testIndex() {
		
		$result = $this->testAction('/kaching/categories/index');

		$this->assertTrue(count($result) == 2);
		
		$category = $result[0]['Category'];		
		$this->assertEqual($category['name'], "Birthday");
		
		$category = $result[1]['Category'];
		$this->assertEqual($category['name'], "Congratulations");			
	}

	function testIndexView() {
		
		$result = $this->testAction('/kaching/categories/index', array("return"=>"contents"));
		
		$this->assertTrue(strpos($result, "<title>Kaching Category Maintenance</title>") > 0);
		$this->assertTrue(strpos($result, "<tr><th>Name</th><th>Page</th><th>Active</th><th>&nbsp;</th></tr>") > 0);
		$this->assertTrue(strpos($result, "Congratulations") > 0);
		$this->assertTrue(strpos($result, "Birthday") > 0);
	}
	
	function testEdit() {
		
		$result = $this->testAction('/kaching/categories/edit/1', array("return"=>"vars"));
		$this->assertTrue(count($result['categories']) == 2);
		
		$result = $this->testAction('/kaching/categories/edit/1');		
		
		$this->assertTrue(count($result) == 1);
		
		$this->assertEqual($result['Category']['name'], "Congratulations");	
	}
	
	function testEditView() {
		
		$result = $this->testAction('/kaching/categories/edit', array("return"=>"contents"));

		$this->assertTrue(strpos($result, '<select name="data[Category][parent_id]" id="CategoryParentId">') > 0);
		$this->assertTrue(strpos($result, '<input name="data[Category][name]"') > 0);		
		$this->assertTrue(strpos($result, '<textarea name="data[Category][description]"') > 0);
		$this->assertTrue(strpos($result, '<input name="data[Category][page]"') > 0);
		$this->assertTrue(strpos($result, '<input type="checkbox" name="data[Category][active]"') > 0);
	}
}	
?>