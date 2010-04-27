<ul class="button-actions button-actions-paypalrefund">
	<li class="button-action-paypalrefund">
		<?php echo $ajax->link(' ', array( 'controller' => 'orders', 'action' => 'paypalRefund', $id ), array( 'id'=>'paypalbutton', 'type'=>'synchronous', 'complete' => 'location.reload(true);' ), 'Are you sure you want to Refund this order to Paypal?'); ?>
	</li>
</ul>