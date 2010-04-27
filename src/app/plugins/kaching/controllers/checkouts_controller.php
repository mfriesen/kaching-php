<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.controllers
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Checkouts controller
 * 
 * This class controls the checkout process 
 *    
 * @author Mike Friesen
 *
 */
class CheckoutsController extends KachingAppController {
		
	var $name = 'Checkout';
	var $viewPath = 'checkout';
	var $uses = array('Kaching.Coupon', 'Kaching.Mailinglist', 'Kaching.Order', 'Kaching.OrderDetail', 
		'Kaching.ProductStore', 'Kaching.Shippingalias', 'Kaching.Shippingzone', 'Kaching.Store', 'Kaching.Storesmtp');
	
	var $layout = "checkouts";
	var $helpers = array('Ajax', 'Session', 'Html', 'Javascript', 'Kaching.Date', 'Kaching.Cart');
	var $components = array('Kaching.ControllerUtil', 'Kaching.ShippingCalculator',
		'Kaching.Cart', 'Kaching.Paypal', 'Kaching.SwiftMailer');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->ControllerUtil->forceSsl();
	}
	
	/**
	 * Makes sure that we have an valid order
	 * @param $cart
	 */
	function __isValidCart($cart)
	{
		if (!isset($cart['OrderDetail']) || empty($cart['OrderDetail']) || !isset($cart['Order']) || !isset($cart['Order']['store_id']))
		{
			$this->redirect("/");
			exit();
		}
	}
	
	/**
	 * The starting page for the checkout process
	 */
	function index() {
		
		$store_number = isset($this->passedArgs['store']) ? $this->passedArgs['store'] : 1;
		$store = $this->Store->findByNumber($store_number);
		$cart = $this->Cart->get($store);
		
		$this->__isValidCart($cart);

		$store_id = $cart['Order']['store_id'];
		$store = $this->Store->findById($store_id);
		$this->set('store', $store);
		$store_number = $store['Store']['number'];
		
		if (!empty($this->data))
		{
			$url = isset($this->data['url']) ? "/" . $this->data['url'] : "/kaching/checkouts/review";
			$details = $cart['OrderDetail'];			
			
			$cart['Order'] = array_merge($cart['Order'], $this->data['Order']);
			$cart['OrderDetail'] = $details;
			
			$this->Order->set($cart);
			$coupon = $this->__getCoupon($store_id, $cart);
			
			if ($coupon != null) {
				$cart['Order']['coupon_code'] = strtoupper($this->data['Order']['coupon_code']);
			}
			
			if ($this->Order->validates()) {
				
				$cart = $this->Cart->recalculate($cart, $store, $coupon);
				$this->Cart->save($cart, $store_number);
			
				$this->redirect($url);
				exit();
			}
		}
		
		$zones = $this->__getShippingzones($store_number);
		$this->set('shippingzones', $zones);
		
		$this->data = $cart;
		$this->Cart->save($cart, $store_number);
	}
	
	/**
	 * Find the coupon for an order, returns null if there isn't any
	 * @param $store_id
	 * @param $cart
	 * @return coupon
	 */
	function __getCoupon($store_id, $cart) {
		
		$coupon_code = isset($cart['Order']['coupon_code']) ? strtoupper($cart['Order']['coupon_code']) : "";

		if (strlen($coupon_code) > 0) {
			return $this->Coupon->findByStoreAndCode($store_id, $coupon_code);
		}

		return null;
	}
	
	/**
	 * Retrieves the shipping zones
	 * @param $store_number
	 */
	function __getShippingzones($store_number=1) {
		
		$this->Shippingzone->recursive = 1;
		$shippingzones = $this->Shippingzone->find('all', array('order'=>'label'));
		
		$retList = array();
		
		foreach ($shippingzones as $zone) {
					
			foreach ($zone['Store'] as $store) {
				
				if ($store['number'] == $store_number) {
					unset($zone['Store']);
					array_push($retList, $zone);
				}
			}
		}
				
		return $retList;
	}
	
	/**
	 * Review order
	 */
	function review() {
		
		$store_number = isset($this->passedArgs['store']) ? $this->passedArgs['store'] : 1;
		$store = $this->Store->findByNumber($store_number);
		$cart = $this->Cart->get($store);
		
		$this->__isValidCart($cart);
		
		$this->data = $cart;

		$store_id = $cart['Order']['store_id'];
		$store = $this->Store->findById($store_id);
		$this->set('store', $store);
	}
	
	/**
	 * Complete order
	 */
	function complete() {
		
		$store_number = isset($this->passedArgs['store']) ? $this->passedArgs['store'] : 1;
		$store = $this->Store->findByNumber($store_number);
		$cart = $this->Cart->get($store);
				
		$this->__isValidCart($cart);

		$store_id = $cart['Order']['store_id'];
		$store = $this->Store->findById($store_id);
		$this->set('store', $store);
		
		$this->__processOnlineMerchant($cart, $store);
		
		$cart = $this->__saveOrder($cart, $store);
		
		$this->data = $cart;

		if (isset($cart['Order']['newsletter']) && $cart['Order']['newsletter'] == 1) {
			$this->__saveNewsletter($cart);
		}
        
		$this->Cart->destroy($store_number);
		$this->__sendOrderEmail($cart, $store);
	}

	/**
	 * Processes the order if the store is a Paypal Website Payments Pro account
	 * @param $cart
	 * @param $store
	 */
	function __processOnlineMerchant(&$cart, $store) {
		
		if ($store['Store']['payment_process'] == "paypal-pro") {
			$this->Paypal->doSalePayment($cart, $store);
		}
	}
	
	/**
	 * Saves the order to the database
	 * @param $cart
	 */
	function __saveOrder($cart, $store) {
		
		$store_id = $cart['Order']['store_id'];
		$store_number = $store['Store']['number'];
		$cart['Order']['inserted_date'] = date("Y-m-d G:i:s", time());
		
		$this->Order->save($cart, $store_number);
		$id = $this->Order->getLastInsertId();
		
		foreach ($cart['OrderDetail'] as $d) {
			$d['order_id'] = $id;
			$this->Order->OrderDetail->create();
			$this->Order->OrderDetail->save(array('OrderDetail'=>$d));
		}
		
		foreach ($cart['OrderDetail'] as $d) {
			$productId = $d['product_id'];
			$qty = $d['qty'];
			
			$conditions = array("store_id"=>$store_id, "product_id"=>$productId, "qty >"=>"0");
			$this->ProductStore->updateAll(array("qty"=>"qty-$qty"), $conditions);
			
			$conditions = array("store_id"=>$store_id, "product_id"=>$productId, "qty ="=>"0");
			$this->ProductStore->updateAll(array("active"=>"0"), $conditions);
		}
		
		return $cart;
	}
	
	/**
	 * Adds email address to the mailinglists table
	 * @param $cart
	 */
	function __saveNewsletter($cart) {
		
		$code = substr(preg_replace('/[\/\\\:*?"<>|.$^1]/', '', crypt(time())), 0, 16);
		$mailingList = array('Mailinglist'=>array('email'=>$cart['Order']['billto_email'],'code'=>$code));
		
		$this->Mailinglist->create();
		$this->Mailinglist->save($mailingList);
	}
	
	/**
	 * Send Order's Email
	 * @param $cart
	 * @param $store
	 */
	function __sendOrderEmail($cart, $store) {
		
		$store_id = $cart['Order']['store_id'];
		$this->set('store', $store);
		
		$smtp = $this->Storesmtp->findByStoreId($store_id);

		if (!empty($smtp)) {
			
			$fromEmail = $store['Store']['email'];
			$name = $store['Store']['name'];
			$toEmail = $cart['Order']['billto_email'];
			$subject = "$name Order Receipt";
			
			$smtpServer = $smtp['Storesmtp']['smtp_server'];
			$smtpPort = $smtp['Storesmtp']['smtp_port'];
			$smtpUsername = $smtp['Storesmtp']['smtp_username'];
			$smtpPassword = $smtp['Storesmtp']['smtp_password'];
			$smtpBcc = $smtp['Storesmtp']['order_bcc'];
			
			$this->SwiftMailer->smtpType     = 'tls';
			$this->SwiftMailer->smtpHost     = $smtpServer;
			$this->SwiftMailer->smtpPort     = $smtpPort;
			$this->SwiftMailer->smtpUsername = $smtpUsername;
			$this->SwiftMailer->smtpPassword = $smtpPassword;
			$this->SwiftMailer->from         = $fromEmail;
			$this->SwiftMailer->fromName     = $name;
			$this->SwiftMailer->to           = $toEmail;
			$this->SwiftMailer->bcc			 = $smtpBcc;
	
			if (!$this->SwiftMailer->send('order', $subject)) {
				$this->log('Error sending email ' . $subject . ' to ' . $toEmail, LOG_ERROR);
			}
		} else {
			$this->log('Error: No SMTP data set', LOG_ERROR);
		}
	}
}
?>