<?php
class CartHelper extends AppHelper
{	
	function getProductStore($product) {

		$p = $this->__getProductStore($product);

		return array(
			$p['id'],
			$p['product_id'],
			$p['store_id'],
			$p['active'],
			$p['qty'],
			$p['variable_pricing'],
			$p['tax1'],
			$p['tax2'],
			$p['shipping'],
			number_format($p['retail_level_1'], 2),
			number_format($p['retail_level_2'], 2),
			number_format($p['retail_level_3'], 2),
			number_format($p['discount_level_1'], 2),
			number_format($p['discount_level_2'], 2),
			number_format($p['discount_level_3'], 2)
			);
	}
	
	function getProduct($product) {
		
		$p = $this->__getProduct($product);
		
		return array(
					$p['id'], 
					$p['number'],
					$p['title'],
					$p['description'],
					$p['keywords'],
					$p['thumbnail'],
					$p['image'],
					$p['page'],
					$p['inserted_date'],
					$p['modified_date']);
	}
	
	function __getProduct($product) {
		
		if (isset($product['Product'])) { 
			$product = $product['Product'];
		} else if (isset($product['products'])) {
			$product = $product['products'];
		}
		return $product;
	}
	
	function __getProductStore($product) {
		
		if (isset($product['ProductStore'])) { 
			$product = $product['ProductStore'];
		} else if (isset($product['product_stores'])) {
			$product = $product['product_stores'];
		}
		return $product;
	}

	/**
	 * Checks to see if product is active. First checks active flag, then see if the all categories product is on are disabled
	 * @param $product
	 * @return true / false
	 */
	function isProductActive($product) {
		
		list($psid, $productid, $storeid, $active) = $this->getProductStore($product);
		
		if ($active == 1) {
			foreach ($product['Category'] as $index => $category):
				if ($category['active'] == 1) {
					return true;
				}
			endforeach;
		}
		
		return false;
	}
}
?>