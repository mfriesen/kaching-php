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
 * Shipping Calculator component
 * 
 * This class calculates shipping costs 
 *    
 * @author Mike Friesen
 *
 */
class ShippingCalculatorComponent extends Object {
	
	function startup( &$controller ) {
		$this->controller = &$controller;
	}
	
	/**
	 * Calculates shipping amount
	 * @param $cart
	 * @param $store
	 * @param $coupon
	 */
	function calculate($cart, $store, $coupon) {
		
		$shippingAmount = 0;
		
		if ($this->__hasProductIncludesShipping($cart)) {
			
			$store_id = $cart['Order']['store_id'];
			$shippingzone = isset($cart['Order']['shippingzone']) ? $cart['Order']['shippingzone'] : "";
			$country = isset($cart['Order']['shipto_country']) ? $cart['Order']['shipto_country'] : "";
			$region = isset($cart['Order']['shipto_region']) ? $cart['Order']['shipto_region'] : "";
			$postalcode = isset($cart['Order']['shipto_postalcode']) ? $cart['Order']['shipto_postalcode'] : "";
			$city = isset($cart['Order']['shipto_city']) ? $cart['Order']['shipto_city'] : "";
		
			$shippingzone = $this->__findShippingZone($store_id, $shippingzone, $country, $region, $postalcode, $city);
			$shippingweight = $this->__calculateShippingWeight($cart);
				
			if ($shippingzone != null && !empty($shippingzone)) {
				$shippingAmount = $this->__getShippingAmount($shippingzone, $shippingweight);
			}
		}

		$cart['Order']['shipping'] = $shippingAmount;
		
		$shippingCoupon = $this->__calculateShippingCoupon($cart, $coupon) * -1;
		$cart['Order']['shipping_coupon'] = $shippingCoupon;
		
		$shippingTax = round( ($shippingAmount + $shippingCoupon) * ($store['Store']['shipping_tax'] / 100), 2);
		$cart['Order']['shipping_tax'] = $shippingTax;
		
		return $cart;
	}
	
	/**
	 * Calculates the shipping amount
	 * @param $cart
	 */
	function getShippingAmount($cart, $shippingzone, $country, $region, $postalcode, $city) {
		$shippingAmount = number_format(0, 2);
		
		if ($this->__hasProductIncludesShipping($cart)) {
			
			$store_id = $cart['Order']['store_id'];
			$zone = $this->__findShippingZone($store_id, $shippingzone, $country, $region, $postalcode, $city);
			$shippingweight = $this->__calculateShippingWeight($cart);
				
			if ($zone != null && !empty($zone)) {
				$shippingAmount = $this->__getShippingAmount($zone, $shippingweight);
			}
		}
		
		return $shippingAmount;
	}
	
	/**
	 * Find the shipping zone for order.
	 * Order for finding shippingzone is:
	 *  1) Check if $shippingzone is set
	 *  2) Check if shippingzone can be found via $country and $postalcode
	 *    NOTE: If country is canada only the first 3 letters of the postal code are used.
	 *  3) Check if shippingzone can be found via $country and $region and $city
	 *  4) Check if shippingzone can be found via $country and $region
	 * 
	 */
	function __findShippingZone($store_id, $shippingzone=null, $country=null, $region=null, $postalcode=null, $city=null) {

		$zone = null;

		$shippingzone = $shippingzone != null && strlen($shippingzone) > 0 ? $shippingzone : null;
		$country = $country != null && strlen($country) > 0 ? $country : null;
		$region = $region != null && strlen($region) > 0 ? $region : null;
		$postalcode = $postalcode != null && strlen($postalcode) > 0 ? $postalcode : null;
		$city = $city != null && strlen($city) > 0 ? $city : null;
		
		if ($shippingzone != null && strlen($shippingzone) > 0) {
			
			$this->controller->Shippingzone->recursive=1;
			$zone = $this->controller->Shippingzone->findById($shippingzone);
			
		} else {

			$joins = array(array('table' => 'store_shippingzones', 'alias' => 'StoreShippingZone', 'type' => 'INNER', 'conditions' => array( 'StoreShippingZone.shippingzone_id = Shippingalias.shippingzone_id')));
			
			if ($country != null && $postalcode != null) {
				$postalcode = $country == "CA" ? substr($postalcode, 0, 3) : $postalcode;
				$conditions = array("country"=>$country, "postalcode"=>$postalcode, "store_id"=>$store_id);
				$alias = $this->controller->Shippingalias->find("first", array('conditions'=>$conditions, 'joins'=>$joins));
			} 

			if (empty($alias) && $country != null && $region != null && $city != null) {
				$conditions = array("country"=>$country, "region"=>$region, "city"=>$city, "store_id"=>$store_id);
				$alias = $this->controller->Shippingalias->find("first", array('conditions'=>$conditions, 'joins'=>$joins));
			}
			
			if (empty($alias) && $country != null && $region != null) {
				$conditions = array("country"=>$country, "region"=>$region, "store_id"=>$store_id);
				$alias = $this->controller->Shippingalias->find("first", array('conditions'=>$conditions, 'joins'=>$joins));			
			}

			if (!empty($alias)) {
				$this->controller->Shippingzone->recursive=1;
				$zone = $this->controller->Shippingzone->findById($alias['Shippingalias']['shippingzone_id']);
			}
		}

		return $zone;
	}
	
	/**
	 * Calculates the Shipping Weight for an order
	 * @param $cart
	 */
	function __calculateShippingWeight($cart) {
		
		$shippingweight = 0;
		
		foreach ($cart['OrderDetail'] as $detail) {
			$shippingweight += isset($detail['Product']['weight']) ? $detail['Product']['weight'] : 0;
		}
		
		return $shippingweight;
	}
	
	/**
	 * Calculates any coupon discount for shipping
	 * @param $cart
	 * @param $coupon
	 */
	function __calculateShippingCoupon($cart, $coupon) {
		
		$couponAmount = 0;
		
		if ($coupon != null) {
			
			$shippingPercent = $coupon['Coupon']['shipping_percent']/100;
			
			if ($shippingPercent != 0) {
	
				$shippingAmount = $cart['Order']['shipping'];
				$couponAmount = round($shippingAmount * $shippingPercent, 2);
			}
		}
		
		return $couponAmount;
	}
	
	/** 
	 * Calculates the shipping amount not including any coupons
	 * @param $zone
	 * @param $shippingweight
	 */
	function __getShippingAmount($zone, $shippingweight) {
		
		$retAmount = 0;
		foreach($zone['Shippingamount'] as $shippingAmount):
		
			$weight = $shippingAmount['weight'];
			$amount = $shippingAmount['amount'];
			
			if ($weight == $shippingweight) {
				return number_format($amount, 2); 
			}
		
			if ($retAmount == 0) {
				$retAmount = $amount;
			}
			
			if ($shippingweight > $weight) {
				$retAmount = $amount;
			}
			
		endforeach;
		
		return number_format($retAmount, 2);
	}
	
	/**
	 * Checks products to see if we charge shipping
	 * @param $cart
	 */
	function __hasProductIncludesShipping($cart) {
		
		foreach ($cart['OrderDetail'] as $detail) {
			
			if ($detail['ProductStore']['shipping'] == 1) {
				return true;
			}
		}
		return false;
	}
}
?>