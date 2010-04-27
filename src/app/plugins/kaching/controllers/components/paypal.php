<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.controllers.components
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Paypal component
 * 
 * This component class controls interaction between controllers and paypal. 
 *    
 * @author Mike Friesen
 *
 */
class PaypalComponent extends Object {
	
	function startup( &$controller ) {
		$this->controller = &$controller;
	}

	/**
	 * Registers an order with Paypal
	 * @param $order - our order
	 * @param $store - the store the order was placed in
	 */
	function doSalePayment(&$order, $store) {
		
		$paypal = ConnectionManager::getDataSource('paypal');
		$response = $paypal->doSalePayment($order, $store['Store']['currency']);
		$ack = $response['ACK'];
		
		if (isset($response['ACK']) && $response['ACK'] == 'Success') {
			
			$order['Order']['status'] = $this->controller->Order->paidAndIncompleteStatus;
			$order['Order']['transactionId'] = $response['TRANSACTIONID'];
			$order['Order']['error'] = "";
		} else {
			
			$error = str_replace("%20", " ", $response['L_SHORTMESSAGE0']);
			$order['Order']['error'] = $error;
		}
	}
	
	/**
	 * Performs a refund for an order with Paypal
	 * @param $order - our order
	 * @param $store - the store the order was placed in
	 */
	function doRefund(&$order, $store) {
		
		$total = $order['Order']['total'];
		$transactionId = $order['Order']['transactionId'];
		
		$paypal = ConnectionManager::getDataSource('paypal');
		$response = $paypal->refundTransaction($transactionId, 'Full', $total, $store['Store']['currency']);		
		$ack = $response['ACK'];
		debug ($response);
		if (isset($response['ACK']) && $response['ACK'] == 'Success') {
			
			$order['Order']['status'] = $this->controller->Order->refund;
			$order['Order']['transactionId'] = $response['REFUNDTRANSACTIONID'];			
			$order['Order']['error'] = "";
		} else {
			 
			$error = str_replace("%20", " ", $response['L_SHORTMESSAGE0']);
			$order['Order']['error'] = $error;
		}
		
	}
}
?>