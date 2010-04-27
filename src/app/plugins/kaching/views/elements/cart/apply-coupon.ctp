<form id="CartCouponForm" method="post" action="/kaching/carts/set_coupon">
	<h3 class='brown margin0'>Redeeming a Coupon Code?</h3>
	<div class="span-13">
		Enter your coupon code here and click the apply button:&nbsp;
		<?php echo $form->text("Order.coupon_code", array("size"=>"16", "maxlength"=>"16")) ?>
		<div><?php echo $form->error("Order.coupon_code") ?></div>
	</div>
	<div class="span-4 last">
		<input type='image' src='/kaching/img/button-apply.png'/>			
	</div>
</form>
<hr/>