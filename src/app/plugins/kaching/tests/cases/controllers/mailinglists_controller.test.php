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

App::import('Controller', 'Kaching.Mailinglists');

/**
 * Mailinglists Controller Tests
 * 
 * @author Mike Friesen
 *
 */
class MailinglistsControllerTest extends CakeTestCase {
	
	var $dropTables = false;
	var $fixtures = array('plugin.kaching.mailinglist');
	 
	function startCase() {
	}
	
	function endCase() {
	}
	
	function startTest($method) {		
	}
	
	function endTest($method) {
	}
	
	function testIndex() {
		
		$result = $this->testAction('/kaching/mailinglists/index');

		$this->assertTrue(count($result) == 1);
		
		$mailinglist = $result[0]['Mailinglist'];		
		$this->assertEqual($mailinglist['email'], "test@test.com");
		$this->assertEqual($mailinglist['name'], "test");
		$this->assertEqual($mailinglist['code'], 1);
	}

	function testIndexSearchNoResults() {
		
		$result = $this->testAction('/kaching/mailinglists/index/q');
		$this->assertTrue(empty($result));
	}

	function testIndexSearch() {
		
		$result = $this->testAction('/kaching/mailinglists/index/test');

		$this->assertTrue(count($result) == 1);
		
		$mailinglist = $result[0]['Mailinglist'];		
		$this->assertEqual($mailinglist['email'], "test@test.com");
		$this->assertEqual($mailinglist['name'], "test");
		$this->assertEqual($mailinglist['code'], 1);
	}

	function testIndexSearchPost() {
		
		$data = array('Mailinglist' => array('q' => "test"));
		$result = $this->testAction('/kaching/mailinglists/index', array('fixturize' => true, 'data' => $data, 'method' => 'post'));

		$this->assertTrue(count($result) == 1);
		
		$mailinglist = $result[0]['Mailinglist'];		
		$this->assertEqual($mailinglist['email'], "test@test.com");
		$this->assertEqual($mailinglist['name'], "test");
		$this->assertEqual($mailinglist['code'], 1);
	}
	
	function testIndexView() {
		
		$result = $this->testAction('/kaching/mailinglists/index', array("return"=>"contents"));

		$this->assertTrue(strpos($result, "<title>Kaching Mailinglist Maintenance</title>") > 0);
		$this->assertTrue(strpos($result, "<tr><th>Email</th><th>&nbsp;</th></tr>") > 0);
		$this->assertTrue(strpos($result, "test@test.com") > 0);
	}
	
	function testAddMailinglist() {

		$result = $this->testAction('/kaching/mailinglists/index');
		$this->assertTrue(count($result) == 1);

		$data = array('Mailinglist' => array('email' => "me@here.com", 'code' => "aa"));
		$result = $this->testAction('/kaching/mailinglists/edit', array('fixturize' => true, 'data' => $data, 'method' => 'post'));
		
		$result = $this->testAction('/kaching/mailinglists/index');
		$this->assertTrue(count($result) == 2);
	}

	function testAddMailinglistWithError() {

		$result = $this->testAction('/kaching/mailinglists/index');
		$this->assertTrue(count($result) == 1);

		$data = array('Mailinglist' => array('code' => "aa"));
		$result = $this->testAction('/kaching/mailinglists/edit', array('fixturize' => true, 'data' => $data, 'method' => 'post'));
		
		$result = $this->testAction('/kaching/mailinglists/index');
		$this->assertTrue(count($result) == 1);
	}
	
	function testDelete() {

		$result = $this->testAction('/kaching/mailinglists/index');
		$this->assertTrue(count($result) == 1);
		
		$result = $this->testAction('/kaching/mailinglists/delete/1');
		
		$result = $this->testAction('/kaching/mailinglists/index');
		$this->assertTrue(empty($result));
	}
	
	function testEdit() {
		
		$result = $this->testAction('/kaching/mailinglists/edit/1');
		
		$this->assertTrue(count($result) == 1);
		
		$this->assertEqual($result['Mailinglist']['email'], "test@test.com");
		$this->assertEqual($result['Mailinglist']['name'], "test");		
	}
	
	function testEditView() {
		
		$result = $this->testAction('/kaching/mailinglists/edit', array("return"=>"contents"));

		$this->assertTrue(strpos($result, '<input name="data[Mailinglist][email]"') > 0);
		$this->assertTrue(strpos($result, '<input name="data[Mailinglist][name]"') > 0);
	}
}
?>