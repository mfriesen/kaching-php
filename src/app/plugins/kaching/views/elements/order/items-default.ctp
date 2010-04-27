<?php
/*
 * $showimage - whether to show the product's image
 * $allowremove - whether to allow the product to be removed cart
 */ 
?>

<?php $showimage = isset($showimage) ? $showimage : false; ?>
<?php $allowremove = isset($allowremove) ? $allowremove : false; ?>

<table class='simple' id='order-details' width="100%" border="1" cellpadding="10" cellspacing="0">
	<tr><th><h4>Product(s)</h4></th><th nowrap><h4>Total ($)</h4></th></tr>

<?php if (!array_key_exists('OrderDetail', $this->data) || empty($this->data['OrderDetail'])) { ?>
	<tr><td colspan='2'><br/>Your Shopping Cart is Empty<br /><br /></td></tr>
	
<?php } else { ?>

<?php $thumbnailUrl = Configure::read('kaching.product-thumbnail.url'); ?>
<?php $thumbnailDir = Configure::read("kaching.product-thumbnail.dir"); ?>

<?php $showimage = isset($showimage) ? $showimage : false; ?>
<?php $allowremove = isset($allowremove) ? $allowremove : false; ?>

	<?php foreach($this->data['OrderDetail'] as $index => $detail): ?>
		<?php 
			$total = number_format($detail['retail'], 2);
	
			$product = $detail['Product'];
			$id = $product['id'];
			$productNumber = $product['number'];
			$title = h($product['title']);
			$image = $product['image'];
			$thumbnail = $product['thumbnail'];
		?>
		
		<tr valign='top'>
			<td>
	
				<table>
					<tr>
						<?php if ($showimage) { ?>
						<td style='border:0px; width:200px;'>
							<?php if ($allowremove) { ?>
							<a id='remove_<?php echo $index?>' href='/kaching/carts/remove/index:<?php echo $index?>' >remove from cart</a><br /><br />
							<?php } ?>
							
							<?php if (is_file($thumbnailDir . "/$thumbnail")) { ?>
								<img alt='<?php echo "$productNumber $title"?>' src='<?php echo $thumbnailUrl?>/<?php echo $thumbnail?>' border='0'/>
							<?php } else { ?>
								<img alt='<?php echo "$productNumber $title"?>' src='/kaching/img/no-image.jpg' border='0'/>
							<?php } ?>
						</td>
						<?php } ?>
						<td style='border:0px;'>
							<h4>Product: <?php echo $productNumber?></h4>
							<h4><?php echo $title ?></h4>
						</td>
					</tr>
				</table>
					
			</td>
			<td class='txt-right' style='width: 100px'><span id='total_<?php echo $index?>'>$<?php echo $total?></span></td>
		</tr>
	<?php endforeach; ?>

<?php } ?>

<?php $couponAmount = isset($this->data['Order']['coupon']) ? number_format($this->data['Order']['coupon'], 2) : 0;?>
<?php if ($couponAmount != 0) { ?>
	<tr><td class='txt-right'><span style='color: red' class='margin0'>Coupon (<?php echo $this->data['Order']['coupon_code'];?>):</span></td><td class='txt-right'>
		<span style='color: red'><?php echo str_replace("-", "-$", "$couponAmount");?></span>
	</td></tr>
<?php } ?>

<?php $shipping = isset($this->data['Order']['shipping']) ? number_format($this->data['Order']['shipping'], 2) : 0;?>
<?php if ($shipping > 0) { ?>
	<tr><td class='txt-right'><span class='margin0'>Shipping:</span></td><td class='txt-right'><span>$<?php echo $shipping?></span></td></tr>
<?php } ?>

<?php $shippingCoupon = isset($this->data['Order']['shipping_coupon']) ? number_format($this->data['Order']['shipping_coupon'], 2) : 0;?>
<?php if ($shippingCoupon != 0) { ?>
	<tr>
		<td class='txt-right'><span style='color: red' class='margin0'>Shipping Coupon (<?php echo $this->data['Order']['coupon_code'];?>):</span></td>
		<td class='txt-right'><span style='color: red'><?php echo str_replace("-", "-$", "$shippingCoupon");?></span></td>
	</tr>
<?php } else if (isset($coupon) && $coupon['Coupon']['shipping_percent'] != 0) { ?>
	<tr>
		<td class='txt-right'><span style='color: red' class='margin0'>Shipping Coupon (<?php echo $this->data['Order']['coupon_code'];?>):</span></td>
		<td class='txt-right'><span style='color: red'><?php echo $coupon['Coupon']['title']?></span></td>
	</tr>
<?php } ?>

<?php $shippingTax = isset($this->data['Order']['shipping_tax']) ? number_format($this->data['Order']['shipping_tax'], 2) : 0;?>
<?php if ($shippingTax > 0) { ?>
	<tr><td class='txt-right'><span class='margin0'>Shipping Tax:</span></td><td class='txt-right'><span>$<?php echo $shippingTax?></span></td></tr>
<?php } ?>

<?php $tax1 = isset($this->data['Order']['tax1']) ? number_format($this->data['Order']['tax1'],2) : 0;?>
<?php if ($tax1 > 0) { ?>
	<tr><td class='txt-right'><span class='margin0'><?php echo $store['Store']['tax1name']?>:</span></td><td class='txt-right'><span>$<?php echo $tax1?></span></td></tr>
<?php } ?>

<?php $tax2 = isset($this->data['Order']['tax2']) ? number_format($this->data['Order']['tax2'],2) : 0;?>
<?php if ($tax2 > 0) { ?>
	<tr><td class='txt-right'><span class='margin0'><?php echo $store['Store']['tax2name']?>:</span></td><td class='txt-right'><span>$<?php echo $tax2?></span></td></tr>
<?php } ?>

<?php $serviceFee = isset($this->data['Order']['service_fee']) ? number_format($this->data['Order']['service_fee'],2) : 0;?>
<?php if ($serviceFee > 0) { ?>
	<tr><td class='txt-right'><span class='margin0'>Service Fee:</span></td><td class='txt-right'><span>$<?php echo $serviceFee?></span></td></tr>
<?php } ?>

<?php $this->dataTotal = isset($this->data['Order']['total']) ? number_format($this->data['Order']['total'], 2) : 0.00; ?>
<tr><td class='txt-right'><span class='margin0'>Total:</span></td><td class='txt-right'><span id='total'>$<?php echo $this->dataTotal?></span></td></tr>

</table>