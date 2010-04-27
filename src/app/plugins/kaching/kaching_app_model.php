<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * KachingApp Model
 * 
 * @author Mike Friesen
 *
 */
class KachingAppModel extends AppModel {
	
    /**
     * Checks two fields to see if they are equal
     * IE: Validate rule
     * array('rule' => array('validateMatch','email', 'email_confirm'), 'message' => '* Email address does not match confirm email'),
     * @param $data
     * @param $field1
     * @param $field2
     * @return unknown_type
     */
    function validateMatch($data, $field1, $field2) {
    	
    	if (isset($this->data[$this->name][$field1]) && isset($this->data[$this->name][$field2])) {
    		return $this->data[$this->name][$field1] == $this->data[$this->name][$field2];
    	}
    	
    	return false;
    }
}
?>