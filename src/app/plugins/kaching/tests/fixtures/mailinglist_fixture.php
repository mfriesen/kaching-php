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

App::import('Model', 'Kaching.Mailinglist');

/**
 * Mailinglist Fixture
 * 
 * @author Mike Friesen
 *
 */
class MailinglistFixture extends CakeTestFixture {

	var $name = 'Mailinglist';
	var $import = array('model' => 'Mailinglist', 'records' => false); 
	var $records = array( 
							array('id' => 1, 'email' => 'test@test.com', 'code' => '1', 'name'=>'test')
						 );
}
?>
