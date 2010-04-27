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
