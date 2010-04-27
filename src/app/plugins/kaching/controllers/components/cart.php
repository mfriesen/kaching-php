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
 * Cart component
 * 
 * This class contains cart helper methods 
 *    
 * @author Mike Friesen
 *
 */
class CartComponent extends Object {
	
	var $session_name = 'cart';
	
	function startup( &$controller ) {
		$this->controller = &$controller;
	}

	/**
	 * Returns the name of the cart
	 * Each store will have their own cart, so you can shop in multiple stores at the same time
	 * but the default checkout process is by store
	 * @param $store
	 */
	function __getSessionName($store_number) {
		return $this->session_name . "_" . $store_number;
	}
	
	/**
	 * Gets the cart session object
	 * @param $store
	 */
	function get($store) {
		
		$store_number = $store['Store']['number'];
		$session_name = $this->__getSessionName($store_number);
		
		$cart = $this->controller->Session->check($session_name) ? $this->controller->Session->read($session_name) : $this->create($store);
								
		$this->save($cart, $store_number);
			
		return $cart;
	}
	
	function __isStoreChanged($cart, $store) {
		
		if (!isset($cart['Order']['store_id']) || $store['Store']['id'] != $cart['Order']['store_id']) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * Saves the cart to the session
	 * @param $cart
	 */
	function save($cart, $store_number) {
		$session_name = $this->__getSessionName($store_number);
		$this->controller->Session->write($session_name, $cart);
	}
	
	/**
	 * Removes cart from Session
	 */
	function destroy($store_number) {
		$session_name = $this->__getSessionName($store_number);
		$this->controller->Session->del($session_name);
	}
	
	/**
	 * Initializes cart
	 * @param $store
	 */
	function create($store) {
		
		$cart = array();
		
		$cart['Order'] = array();
		$cart['Order']['store_id'] = $store['Store']['id'];
		
		$cart['OrderDetail'] = array();
		
		$cart = $this->recalculate($cart, $store, null);
				
		return $cart;
	}
	
	/**
	 * Recalculates the cart
	 */
	function recalculate($cart, $store) {
		
		$store_id = $store['Store']['id'];
		$subtotal = $this->subtotal($cart);
		$cart['Order']['subtotal'] = $subtotal;
				
		// update coupons
		$coupon_code = isset($cart['Order']['coupon_code']) ? $cart['Order']['coupon_code'] : "";
		$coupon = $this->controller->Coupon->findByStoreAndCode($store_id, $coupon_code);
		$coupon_amount = $this->coupon($coupon, $subtotal) * -1;
		$cart['Order']['coupon'] = $coupon_amount;

		// update taxes
		$taxes = $this->taxes($cart, $store, $coupon);
		foreach ($taxes as $key => $value) {
			$cart['Order'][$key] = $value;
		}
		
		// update shipping
		$cart = $this->controller->ShippingCalculator->calculate($cart, $store, $coupon);
		
		$total = $this->total($cart, $store, $coupon);
		$cart['Order']['total'] = $total;

		return $cart;
	}
	
	/**
	 * Calculates the order total
	 * @param $cart
	 * @param $store
	 * @param $coupon
	 */
	function total($cart, $store, $coupon=null) {
		
		$subtotal = $this->subtotal($cart);
		
		$taxes = $this->taxes($cart, $store, $coupon);

		$tax = array_sum(array_values($taxes));
		
		$coupon_amount = $this->coupon($coupon, $subtotal) * -1;
				
		$shipping = isset($cart['Order']['shipping']) ? $cart['Order']['shipping'] : 0;
		$shippingCoupon = isset($cart['Order']['shipping_coupon']) ? $cart['Order']['shipping_coupon'] : 0;
		$shippingTax = isset($cart['Order']['shipping_tax']) ? $cart['Order']['shipping_tax'] : 0;
		
		$total = $subtotal + $tax + $shipping + $shippingTax + $coupon_amount + $shippingCoupon;

		return number_format($total, 2);
	}
	
	/**
	 * Calculates the total for the details
	 * @param $cart
	 */
	function subtotal($cart) {
		
		$total = 0;

		foreach ($cart['OrderDetail'] as $detail) {
			
			$qty = $detail['qty'];
			$retail = $detail['retail'];
			$total += $qty * $retail;
		}
		
		return number_format($total, 2);
	}
	
	/**
	 * Calculates the Taxes
	 * @param $cart
	 * @param $store
	 * @param $coupon
	 */
	function taxes($cart, $store, $coupon=null) {

		$subtotals = array();
		
		foreach ($store['Store'] as $key => $value) {
			if ($this->string_begins_with($key, "tax")) {
				$subtotals[$key] = 0;
			}
		}
		
		foreach ($cart['OrderDetail'] as $detail) {
			
			$qty = $detail['qty'];
			$retail = $detail['retail'];

			foreach ($subtotals as $key => $value) {

				if (isset($detail['ProductStore'][$key]) && $detail['ProductStore'][$key] == 1) {
					$subtotals[$key] = $value + number_format($qty * $retail, 2);
				}
			}
		}
				
		$taxes = array();
		foreach ($subtotals as $key => $value) {
			$tax = $store['Store'][$key] / 100;
			$coupon_amount = $this->coupon($coupon, $value);
			$taxes[$key] = number_format( ($value - $coupon_amount) * $tax, 2);
		}

		return $taxes;
	}
	
	function string_begins_with($string, $search) {
    	return (strncmp($string, $search, strlen($search)) == 0);
	}
	
	/**
	 * Calculates the coupon discount amount
	 * @param $coupon
	 * @param $detailTotal
	 */
	function coupon($coupon, $subtotal) {

		$coupon_amount = 0;
		
		if ($coupon != null) {

			$percent = $coupon['Coupon']['percent'] / 100;
			$amount = $coupon['Coupon']['amount'];
			$coupon_amount = round($subtotal * $percent + $amount, 2);
		}

		return number_format($coupon_amount, 2);
	}
	
	function set_coupon($cart, $code) {

		$store_id = $cart['Order']['store_id'];
		$active = $this->controller->Coupon->isActive($store_id, $code);
		
		if ($active) {

			$coupon = $this->controller->Coupon->findByStoreAndCode($store_id, $code);
			
			$min_amount = $coupon['Coupon']['min_amount'];
			$subtotal = $this->subtotal($cart);
		
			if ($this->__isProductDiscounted($cart)) {
				$this->controller->Order->invalidate("coupon_code", "* Coupon cannot be used. Product(s) in cart already discounted");				
			} else if ($subtotal < $min_amount) {
				
				$this->controller->Order->invalidate("coupon_code", "* Coupon minimum order amount is $$min_amount");	
			} else { // coupon is okay
				
				$cart['Order']['coupon_code'] = $code;				
				$store = $this->Store->findById($store_id);
				$cart = $this->recalculate($cart, $store, $coupon);
			}
			
		} else {
			$this->controller->Order->invalidate("coupon_code", "* Invalid Coupon Code");
		}
		
		return $cart;
	}
	
	/**
	 * Checks to see if order has already discounted products
	 * Disallows using a coupon if a product on the order is already discounted.
	 * @param $cart
	 */
	function __isProductDiscounted($cart) {
		
		foreach ($cart['OrderDetail'] as $detail) {
			
			$retail = number_format($detail['retail'], 2);
			if ($detail['ProductStore']['discount_level_1'] == $retail 
				|| $detail['ProductStore']['discount_level_2'] == $retail 
				|| $detail['ProductStore']['discount_level_3'] == $retail) {
				return true;
			}
		}
		return false;
	}
}
?>