<div class="span-6">

	<form id="CartSearchForm" class="inline" action="/kaching/carts/search" method="post">
		<?php $v = isset($q) ? $q : ""?>
		<div class="span-4"><?php echo $form->text("Cart.q", array("size"=>"19", "maxlength"=>"20", "value"=>$v)) ?></div>
		<div class="span-1"><input name='search' type='image' src='/kaching/img/sample-store/magnify_glass.png' style='width: 35px;' /></div>
		<br />				
	</form>

	<?php echo $this->element("sample-store/categories")?>

	<ul class="side-box">	
		<li><h4><strong><a class='side-box' href="/kaching/carts/view">View Cart</a></strong></h4></li>
		<li><h4><strong><a class='side-box' href="/kaching/checkouts/index">Checkout</a></strong></h4></li>
		<li><h4><strong><a class='side-box' href="/kaching/users/index">Kaching Admin Login</a></strong></h4></li>
	</ul>			
</div>