<div id="menu" class="span-20">
	<div class="span-20">
		<ul class="menutabs">
			<li><a href="/"><span>Demo Store</span></a></li>
			<li><a href="http://github.com/mfriesen/kaching-php"><span>Project Page</span></a></li>
		</ul>
	</div>
	<div class="span-4 txt-center last">
		<?php $total = isset($this->data['Order']['total']) ? $this->data['Order']['total'] : 0;?>
		<div class="span-2 txt-right"><a href='/kaching/carts/view'><img src='/kaching/img/cart.png' style='padding-top:5px;'/></a></div>			
		<div class="span-1 txt-left" id="retailTotal" style="color:red;"><strong>$<?php echo number_format($total, 2); ?></strong></div>
	</div>		
</div>