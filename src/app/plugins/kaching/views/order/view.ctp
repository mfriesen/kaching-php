<?php $this->set("title_for_layout", "Kaching: Order") ?>

<?php $statusMessages = $orderUtil->getOrderStatusMessages();?>
<?php $statusColours = $orderUtil->getOrderStatusColours();?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')) ?>

<?php $id = $this->data['Order']['id'];?>
<?php $status = $this->data['Order']['status']; ?>

<div class="span-24"><a target="none" href='/kaching/orders/printview/<?php echo $id?>' id='print_button'><img border='0' src='/kaching/img/print-icon.gif' /> - Print Order</a><br /><br /></div>

<div class="span-12"><h4><strong>Store:</strong> <?php echo $store['Store']['name']?>&nbsp;(&nbsp;Number:&nbsp;<?php echo $store['Store']['number']?>&nbsp;)</h4></div>

<div class="span-11 txt-right ">
	<h4 class="margin0"><strong>Order Status:</strong>&nbsp;&nbsp;<span style="color: <?php echo $statusColours[$status]?>"><?php echo $statusMessages[$status]?></span></h4>
</div>

<?php if (strlen($order['Order']['transactionId']) > 0) { ?>
	<div class="span-8 txt-right ">
		<h4 class="margin0"><strong>Transaction Id:</strong></h4>
	</div>
	
	<div class="span-4 txt-right last">	
		<h4 class="margin0"><?php echo $order['Order']['transactionId']?></h4>
	</div>
<?php } ?>

<?php if (strlen($order['Order']['error'])) { ?>
	<div class="span-24 txt-center">	
		<h4 class="margin0 error"><strong>Order Error:</strong>&nbsp;<?php echo $order['Order']['error']?></h4>
	</div>
<?php } ?>
<div class="clear"></div>

<form class='inline' action="">
	<?php echo $this->element("order/form", array('plugin'=>'kaching')) ?>
	<?php echo $this->element("order/items", array('plugin'=>'kaching'))?>
</form>

<br />

<div class="span-2">
	<?php if ( ($status == 0 || $status == 3) && $store['Store']['payment_process'] == "paypal-pro") {?>
	
		<?php echo $this->element("order/button-paypal", array('plugin'=>'kaching', "id"=>$id))?>
		
	<?php } else if ($status == 0 || $status == 2 ){ ?>
	
		<?php echo $this->element("order/button-complete", array('plugin'=>'kaching', "id"=>$id, "store"=>$store))?>
		
	<?php } ?>
</div>

<div class="span-19">&nbsp;</div>

<div class="span-3 last">
<?php if ($status == 0) { ?>

	<?php echo $this->element("order/button-cancel", array("id"=>$id))?>
	
<?php } else if ( ($status == 1 || $status == 2) && $store['Store']['payment_process'] == "paypal-pro") { ?>

	<?php echo $this->element("order/button-paypal-refund", array('plugin'=>'kaching', "id"=>$id))?>
	
<?php } ?>
</div>

<div class="clear">&nbsp;</div>