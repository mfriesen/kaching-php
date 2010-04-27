<?php $credit_cards = $store['Store']['credit_cards']?>

<?php if ($credit_cards == 1) { ?>
<ul class="button-actions button-actions-complete">
	<li class="button-action-complete">
		<?php echo $ajax->link(' ', array( 'controller' => 'orders', 'action' => 'completeKeepCreditCard', $id ), array( 'id'=>'completebutton', 'type'=>'synchronous', 'complete' => 'location.reload(true);' ), 'Do you want to Complete the order? Credit Card Number will remain.'); ?>
	</li>
</ul>
<?php } else { ?>
<ul class="button-actions button-actions-complete">
	<li class="button-action-complete">
		<?php echo $ajax->link(' ', array( 'controller' => 'orders', 'action' => 'complete', $id ), array( 'id'=>'completebutton', 'type'=>'synchronous', 'complete' => 'location.reload(true);' ), 'Do you want to Complete the order? Credit Card Number will disappear!'); ?>
	</li>
</ul>
<?php } ?>