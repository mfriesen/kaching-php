<h2><strong>What's in your Shopping Cart?</strong></h2>

<?php echo $this->element("cart/apply-coupon", array("plugin"=>"kaching"))?>

<table class='simple' id='order-details' width="100%" border="1" cellpadding="10" cellspacing="0">
	
	<?php echo $this->element("order/items-header", array('plugin'=>'kaching'))?>
	
	<?php if (!array_key_exists('OrderDetail', $this->data) || empty($this->data['OrderDetail'])) { ?>
	
		<?php echo $this->element("order/items-empty", array('plugin'=>'kaching'))?>
		
	<?php } else { ?>
	
		<?php echo $this->element("order/items-lines-removable", array('plugin'=>'kaching'))?>
	
		<?php echo $this->element("order/items-footer", array('plugin'=>'kaching'))?>
	
	<?php } ?>
</table>

<div class="span-15">&nbsp;</div>
<div class="span-3 last">
	<br />
	
	<ul class="button-actions button-actions-checkout">
		<li class="button-action-checkout">
			<a id="checkout_button" href="/kaching/checkouts"></a>
		</li>
	</ul>
</div>

<div class="clear">&nbsp;</div>
<?php echo $this->element("cart/calculate-shipping", array("plugin"=>"kaching"))?>