<?php
class CartHelper extends AppHelper
{	
	/**
	 * Call product_store instead
	 * @deprecated
	 * @param $product
	 */
	function getProductStore($product) {
		return $this->product_store($product);
	}
	
	/**
	 * Returns the number of items in the cart
	 */
	function cart_item_count($cart) {
		return isset($cart['OrderDetail']) ? count($cart['OrderDetail']) : 0;
	}
	
	function total($cart) {
		$total = isset($cart['Order']['total']) ? $cart['Order']['total'] : 0;
		return number_format($total, 2);
	}
	
	/**
	 * Returns product store variables as a list
	 * @param $product
	 */
	function product_store($product) {

		$p = $this->__get_product_store($product);

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
	
	/**
	 * call product($product) instead
	 * @deprecated
	 * @param $product
	 */
	function getProduct($product) {
		return $this->product($product);
	}
	
	/**
	 * Returns product variables as a list 
	 * @param $product
	 */
	function product($product) {		
		$p = $this->__get_product($product);
		
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
	
	function __get_product($product) {
		
		if (isset($product['Product'])) { 
			$product = $product['Product'];
		} else if (isset($product['products'])) {
			$product = $product['products'];
		}
		return $product;
	}
	
	function __get_product_store($product) {
		
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
	
	/**
	 * Returns the URL to the product's page
	 * @param $product
	 */
	function product_page($product) {
		list($id, $number, $title, $description, $keywords, $thumbnail, $image, $page) = $this->getProduct($product);
		return strlen($page) > 0 ?	"/product/$page" : "/kaching/carts/product/id:$id";
	}
	
	/**
	 * Returns thumbnail url
	 * @param $product
	 */
	function thumbnail_url($product) {
		$thumbnailDir = Configure::read("kaching.product-thumbnail.dir");
		$thumbnailUrl = Configure::read('kaching.product-thumbnail.url');		
		list($id, $number, $title, $description, $keywords, $thumbnail, $image, $page) = $this->getProduct($product);
		return is_file("$thumbnailDir/$thumbnail") ? "$thumbnailUrl/$thumbnail" : "/kaching/img/no-image.jpg";
	}

	/**
	 * Returns the min / max range of the retail levels
	 */
	function retail_range($product) {
		list($psid, $productid, $storeid, $active, $qty, $vpricing, $tax1, $tax2, $shipping, $retailLevel1, $retailLevel2, $retailLevel3, $discountLevel1, $discountLevel2, $discountLevel3) = $this->product_store($product);
		$a = array($retailLevel1, $retailLevel2, $retailLevel3, $discountLevel1, $discountLevel2, $discountLevel3);
		
		foreach ($a as $i => $v):
			if ($v == 0)
				unset($a[$i]);
		endforeach;

		return array(min($a), max($a));
	}

	/**
	 * Returns either URL friendly category page or the CakePHP version of it
	 * @param $category
	 */
	function category_page($category) {
		return strlen($category['Category']['page']) > 0 ? "/category/" . $category['Category']['page'] : "/kaching/carts/category/" . $category['Category']['id'];
	}
}
?>