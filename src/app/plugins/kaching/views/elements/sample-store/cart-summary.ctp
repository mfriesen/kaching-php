<div class="span-3 txt-right last">
	<a href='/kaching/carts/view'><img src='/kaching/img/cart.png' style='padding-top:5px;'/></a>
	<p>
		$<?php echo $cart->total($this->data);?>
		(<?php echo $cart->cart_item_count($this->data);?> items)
	</p>
</div>		
