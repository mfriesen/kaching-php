<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.models.datasources
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::import('Core', array('Xml', 'HttpSocket'));

/**
 * Groups controller
 * 
 * This class controls interaction with paypal
 *    
 * @author Mike Friesen
 *
 */
class PaypalSource extends DataSource {
	
	var	$userName = "";
	var	$password = "";
	var	$signature = "";
	var $environment = '';		
	
	var $http = null;
	
	//class var
	var $nvpStr = null;
  	var $nvpreq = null;

  	/**
  	 * setup parameters from the config/database.php file
  	 * @param $config
  	 */
	function __construct($config) {
		parent::__construct($config);
				
		$this->http =& new HttpSocket();
		
    	$this->userName = $this->config['username'];
    	$this->password = $this->config['password'];
    	$this->signature = $this->config['signature'];
    	$this->environment = $this->config['environment'];
	}
	
	/**
	 * Send Payment to Paypal 
	 * @param $order
	 * @param $currency
	 */
	function doSalePayment($order, $currency) {
		return $this->__doPayment($order, $currency, "Sale");
	}
	
	/**
	 * Send Authorization Payment request to Paypal
	 * @param $order
	 * @param $currency
	 */
	function isAuthorizedPayment($order, $currency) {
		return $this->__doPayment($order, $currency, "Authorization");
	}

	function __get6CharacterExpiryMonth($expiry) {
		
		if (strlen($expiry) == 4) {
			$expiry = substr($expiry, 0, 2) . substr(date('Y'), 0, 2) . substr($expiry, 2);
		}

		return $expiry;
	}
	
	/**
	 * Send Payment to Paypal depending on the payment type 
	 * @param $order
	 * @param $currency
	 * @param $paymentType - Either Authorization or Sale
	 */
	function __doPayment($order, $currency, $paymentType) {
		
		$billToName = urlencode($order['Order']['billto_name']);
		
		// credit card info
		$creditCardType = urlencode($order['Order']['credit_card']);
		$creditCardNumber = urlencode($order['Order']['credit_card_number']);
		//$creditCardNumber = "4605198024170691";
		$creditCardExpiry = urlencode($this->__get6CharacterExpiryMonth($order['Order']['credit_card_expiry']));
		$creditCardSecurityCode = isset($order['Order']['security_code']) ? urlencode($order['Order']['security_code']) : "";

		// billing address
		$address1 = urlencode($order['Order']['billto_address']);
		$city = urlencode($order['Order']['billto_city']);
		$province = urlencode($order['Order']['billto_region']);
		$postalcode = urlencode($order['Order']['billto_postalcode']);
		$country = urlencode($order['Order']['billto_country']);
		$amount = urlencode($order['Order']['total']);
		$currency = urlencode($currency);
		
		// Add request-specific fields to the request string.
		$this->nvpStr =	"&PAYMENTACTION=$paymentType" . 
					"&AMT=$amount" . 
					"&CREDITCARDTYPE=$creditCardType" . 
					"&ACCT=$creditCardNumber" .
					"&EXPDATE=$creditCardExpiry" . 
					"&CVV2=$creditCardSecurityCode" . 
					"&FIRSTNAME=$billToName" . 
					"&LASTNAME=".
					"&STREET=$address1" . 
					"&CITY=$city" . 
					"&STATE=$province" . 
					"&ZIP=$postalcode" . 
					"&COUNTRYCODE=$country" . 
					"&CURRENCYCODE=$currency";
		
		return $this->query("doDirectPayment");
	}
	
	/**
	 * Refund the transaction 
	 * 
	 * @param $transaction_id
	 * @param String $refund_type
	 * @param float $amount
	 * @param String $memo
	 * @return mixed    array if success, false otherwise.
	 */
	function refundTransaction($transaction_id, $refund_type = 'Full', $amount = null, $currency, $memo = null) {		
		// Set request-specific fields.
		$transactionID = urlencode($transaction_id);
		$refundType = urlencode($refund_type);					// or 'Partial'

		if(isset($amount) && isset($memo) && $refund_type === 'Partial') {
			$this->nvpStr = "&TRANSACTIONID=$transactionID&REFUNDTYPE=$refundType&CURRENCYCODE=$currency&AMOUNT=$amount&MEMO=$memo";
		} else {
			$this->nvpStr = "&TRANSACTIONID=$transactionID&REFUNDTYPE=$refundType&CURRENCYCODE=$currency";
		}		
			
		return $this->query("RefundTransaction");
	}
		
    /**
     * Performs the communication with the paypal api
     * 
     * In case of error it returns false 
     * @return mixed array if success, false otherwise.
     * 
     */
    function query($methodName) {
    	
    	// Set up your API credentials, PayPal end point, and API version.
		$API_UserName = urlencode($this->userName);
		$API_Password = urlencode($this->password);
		$API_Signature = urlencode($this->signature);
				
		$API_Endpoint = "https://api-3t.paypal.com/nvp";		
		if("sandbox" === $this->environment || "beta-sandbox" === $this->environment) {
			$API_Endpoint = "https://api-3t.$this->environment.paypal.com/nvp";
		}
		$version = urlencode('51.0');
	
		// Set the API operation, version, and API signature in the request.
		$this->nvpreq = "METHOD=$methodName&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$this->nvpStr";
		
		//call the web service
		$response = $this->http->post($API_Endpoint, $this->nvpreq);
			
		if(!$response) {
			return false;
		}
	
		// Extract the response details.
		$httpResponseAr = explode("&", $response);
	
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
		
		return $httpParsedResponseAr;
    }
}
?>