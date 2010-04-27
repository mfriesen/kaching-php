<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.models
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Mailinglist Model
 * 
 * @author Mike Friesen
 *
 */
class Mailinglist extends KachingAppModel {
	
	var $name = 'Mailinglist';
	var $recaptcha_challenge_field = "recaptcha_challenge_field";
    
	var $validate = array('email' => 
						array(
							array('rule' => 'email', 'message' => 'Enter valid Email address', 'required'=>true), 
							array('rule' => 'isUnique', 'message' => 'Email address already registered', 'required'=>true),
						),
					  'code' => array('rule' => 'notEmpty', 'message' => 'Code cannot be null'),
					  'recaptcha_challenge_field' => array('rule' => 'validateCaptcha', 'message' => 'Incorrect Captcha', 'required'=>false)
				);
    
	function validateCaptcha($data) {
		
		if (isset($_POST[$this->recaptcha_challenge_field]) && isset($_POST["recaptcha_response_field"])) {
			$privateKey = Configure::read('kaching.captcha.privatekey');
			$resp = recaptcha_check_answer ($privateKey,
	        		                        $_SERVER["REMOTE_ADDR"],
	                		                $_POST[$this->recaptcha_challenge_field],
	                        		        $_POST["recaptcha_response_field"]);
	
	        return $resp->is_valid;
		} else {
			return false;
		}
	}
}

?>
