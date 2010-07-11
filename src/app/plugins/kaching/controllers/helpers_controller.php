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
 * Helpers controller
 * 
 * This class contains helper methods
 * Current the helper methods revolve around shipping 
 *    
 * @author Mike Friesen
 *
 */
class HelpersController extends KachingAppController
{
	var $name = 'Help';
	var $layout = "blank";
	var $viewPath = "helper";
	var $uses = array('Kaching.Country', 'Kaching.Order', 'Kaching.Region', 
		'Kaching.Shippingzone', 'Kaching.Shippingalias', 'kaching.Store');
	var $components = array('RequestHandler', 'Kaching.ShippingCalculator', 'Kaching.Cart');
	
	/**
	 * @return list of countries
	 */
	function get_countries() {
		return $this->Country->find("list", array('fields'=> array('id','name'), "order"=>array("name"=>"asc")));
	}
	
	/**
	 * Gets regions for a country
	 * @param $country_id
	 */
	function get_regions($country_id) {
		
		$conditions = array("country_id"=>$country_id);
		$this->data = $this->Region->find("list", array('conditions'=>$conditions, 'fields'=> array('id','name'), "order"=>array("name"=>"asc")));
		return $this->data;
	}
	
	/**
	 * Retrieves the shipping zones
	 * @param $store_number
	 */
	function get_shippingzones($store_number=1) {
		
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
	
	function get_holidays($store_id) {
		$this->Store->recursive = 1;

		$store = $this->Store->findById($store_id);
		
		$ret = array();
		foreach ($store['StoreHoliday'] as $holiday) {
			$ret[$holiday['date']] = $holiday['date'];
		}
		
		return $ret;
	}
	
	/**
	 * Calculates Shipping - used to determine how much shipping would be 
	 */
	function calculate_shipping() {
		
		$store_number = isset($this->passedArgs['store']) ? $this->passedArgs['store'] : 1;
		$shippingzone = isset($this->data['Order']['shippingzone']) ? $this->data['Order']['shippingzone'] : null;
		$country = isset($this->data['Order']['shipto_country']) ? $this->data['Order']['shipto_country'] : null;
		$postalcode = isset($this->data['Order']['shipto_postalcode']) ? $this->data['Order']['shipto_postalcode'] : null;
		$region = isset($this->data['Order']['shipto_region']) ? $this->data['Order']['shipto_region'] : null;
		$city = isset($this->data['Order']['shipto_city']) ? $this->data['Order']['shipto_city'] : null;

		$store = $this->Store->findByNumber($store_number);
		$cart = $this->Cart->get($store);

		$amount = $this->ShippingCalculator->getShippingAmount($cart, $shippingzone, $country, $region, $postalcode, $city);
		$this->data['shipping'] = $amount;
		
		if ($this->RequestHandler->isAjax()) {
			$this->render("calculate_shipping_ajax","blank");
		} else {
			$this->render("calculate_shipping","carts");	
		}
	}
	
	/**
	 * Used by ajax call to update the selectable regions
	 */
	function update_shipto_region_select() {
		
		if(!empty($this->data['Order']['shipto_country'])) {
			$this->data = $this->get_regions($this->data['Order']['shipto_country']);
		}

		$this->render("get_regions","blank");
	}
	
	function update_billto_region_select() {
		
		if(!empty($this->data['Order']['billto_country'])) {
			$this->data = $this->get_regions($this->data['Order']['billto_country']);
		}
	  	    
		$this->render("get_regions","blank");
	}
}
?>