
<table class='simple' id='order-details' width="100%" border="1" cellpadding="10" cellspacing="0">
	
	<?php echo $this->element("order/items-header", array('plugin'=>'kaching'))?>
	
	<?php if (!array_key_exists('OrderDetail', $this->data) || empty($this->data['OrderDetail'])) { ?>
	
		<?php echo $this->element("order/items-empty", array('plugin'=>'kaching'))?>
		
	<?php } else { ?>
	
		<?php echo $this->element("order/items-lines", array('plugin'=>'kaching'))?>
	
		<?php echo $this->element("order/items-footer", array('plugin'=>'kaching'))?>
	
	<?php } ?>
</table>