<ul class="button-actions button-actions-paypalpayment">
	<li class="button-action-paypalpayment">
		<?php echo $ajax->link(' ', array( 'controller' => 'orders', 'action' => 'paypalPayment', $id ), array( 'id'=>'paypalbutton', 'type'=>'synchronous', 'complete' => 'location.reload(true);' ), 'Do you want to send this order to Paypal for Payment?'); ?>
	</li>
</ul>