<?php

App::import('Model','Kaching.Coupon');
App::import('Component', 'Kaching.Cart');

class FakeCartController {}
class CouponTest extends Coupon {
    var $useDbConfig = 'test_suite';
} 

class CartTestCase extends CakeTestCase {
	
	var $fixtures = array('plugin.kaching.category', 'plugin.kaching.coupon', 'plugin.kaching.order', 'plugin.kaching.order_detail', 
		'plugin.kaching.product', 'plugin.kaching.product_store', 'plugin.kaching.product_category',
		'plugin.kaching.shippingzone', 'plugin.kaching.shippingamount', 'plugin.kaching.shippingalias',
		'plugin.kaching.store_shippingzone',
		'plugin.kaching.store', 'plugin.kaching.storesmtp'
	);
		
	var $store = array("Store"=> array("number"=>1, "name"=>"test", "website"=>"test", "email"=>"asd@here.com", 
			"tax1"=>7, "tax2"=>5, "shipping_tax"=>10, "service_fee"=>20, "payment_process"=>0, "currency"=>"CDN")
	 );

	var $cart1 = array("Order"=>array('store_id'=>1), "OrderDetail"=>array(array('retail'=>10, 'qty'=>1, 'ProductStore'=>array('tax1'=>1, 'tax2'=>1))));
	var $cart2 = array("Order"=>array('store_id'=>1), 
		"OrderDetail"=>array(
			array('retail'=>5, 'qty'=>1, 'ProductStore'=>array('discount_level_1'=>0, 'discount_level_2'=>0, 'discount_level_3'=>0,'tax1'=>1, 'tax2'=>1)))
	);
	var $cart3 = array("Order"=>array('store_id'=>1), 
		"OrderDetail"=>array(
			array('retail'=>30, 'qty'=>1, 'ProductStore'=>array('discount_level_1'=>30, 'discount_level_2'=>0, 'discount_level_3'=>0,'tax1'=>1, 'tax2'=>1)))
	);
	 
	function testTaxesNoCoupon() {
		
		$this->CartComponentTest = new CartComponent();
		
		$result = $this->CartComponentTest->taxes($this->cart1, $this->store, null);
		$this->assertEqual($result['tax1'], "0.70");
		$this->assertEqual($result['tax2'], "0.50");
	}
	
	function testTaxesPercentCoupon() {
		
		$coupon = array('Coupon'=>array('percent'=>15, 'amount'=>0, 'min_amount'=>0));
		$this->CartComponentTest = new CartComponent();
		
		$result = $this->CartComponentTest->taxes($this->cart1, $this->store, $coupon);
		$this->assertEqual($result['tax1'], "0.60");
		$this->assertEqual($result['tax2'], "0.43");
	}
	
	function testTaxesFlatRateCoupon() {
		$coupon = array('Coupon'=>array('percent'=>0, 'amount'=>3, 'min_amount'=>0));
		$this->CartComponentTest = new CartComponent();
		
		$result = $this->CartComponentTest->taxes($this->cart1, $this->store, $coupon);
		$this->assertEqual($result['tax1'], "0.49");
		$this->assertEqual($result['tax2'], "0.35");		
	}
		
	function testSubtotal() {

		$cart = array("Order"=>array(), "OrderDetail"=>array(
			array('retail'=>10, 'qty'=>1, 'ProductStore'=>array('tax1'=>1, 'tax2'=>1)),
			array('retail'=>17, 'qty'=>1, 'ProductStore'=>array('tax1'=>1, 'tax2'=>1))
		));
		
		$result = $this->CartComponentTest->subtotal($this->cart1);
		$this->assertEqual(10, $result);
		
		$result = $this->CartComponentTest->subtotal($cart);
		$this->assertEqual(27, $result);
	}
	
	function testTotal() {

		$cart = array("Order"=>array('tax1'=>0, 'tax2'=>0, 'total'=>0), "OrderDetail"=>array(
			array('retail'=>10, 'qty'=>1, 'ProductStore'=>array('tax1'=>1, 'tax2'=>1)),
			array('retail'=>17, 'qty'=>1, 'ProductStore'=>array('tax1'=>1, 'tax2'=>1))
		));
		
		$result = $this->CartComponentTest->total($cart, $this->store);
		$this->assertEqual(30.24, $result);
	}
	
	function testRecalculate() {

		$cart = array("Order"=>array('tax1'=>0, 'tax2'=>0, 'total'=>0), "OrderDetail"=>array(
			array('retail'=>10, 'qty'=>1, 'ProductStore'=>array('tax1'=>1, 'tax2'=>1)),
			array('retail'=>17, 'qty'=>1, 'ProductStore'=>array('tax1'=>1, 'tax2'=>1))
		));
		
		$result = $this->CartComponentTest->recalculate($cart, $this->store);
		
		$this->assertEqual(27.00, $result['Order']['subtotal']);
		$this->assertEqual(1.89, $result['Order']['tax1']);
		$this->assertEqual(1.35, $result['Order']['tax2']);
		$this->assertEqual(0.00, $result['Order']['coupon']);
		$this->assertEqual(30.24, $result['Order']['total']);
	}
	
	function testInvalidCouponCode() {

		$controller = new FakeCartController();
		$controller->Coupon = new Coupon();
		$controller->Order = new Order();
		$this->CartComponentTest->startup(&$controller);

		$result = $this->CartComponentTest->set_coupon($this->cart1, "bleh");
		$this->assertEqual("* Invalid Coupon Code", $controller->Order->validationErrors['coupon_code']);
	}
	
	function testCouponCodeInvalidMinAmount() {

		$this->CartComponentTest = new CartComponent();
		$controller = new FakeCartController();
		$controller->Coupon = new CouponTest();
		$controller->Order = new Order();
		$this->CartComponentTest->startup(&$controller);

		$result = $this->CartComponentTest->set_coupon($this->cart2, "10percent");
		$this->assertEqual("* Coupon minimum order amount is $20", $controller->Order->validationErrors['coupon_code']);
	}
	
	function testCouponCodeAlreadyDiscounted() {

		$this->CartComponentTest = new CartComponent();
		$controller = new FakeCartController();
		$controller->Coupon = new CouponTest();
		$controller->Order = new Order();
		$this->CartComponentTest->startup(&$controller);

		$result = $this->CartComponentTest->set_coupon($this->cart3, "10percent");
		$this->assertEqual("* Coupon cannot be used. Product(s) in cart already discounted", $controller->Order->validationErrors['coupon_code']);
	}
}
?>