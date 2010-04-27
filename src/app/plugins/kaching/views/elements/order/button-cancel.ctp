<ul class="button-actions button-actions-cancel">
	<li class="button-action-cancel">
		<?php echo $ajax->link(' ', array( 'controller' => 'orders', 'action' => 'cancel', $id ), array( 'id'=>'cancelbutton', 'complete' => 'location.reload(true);' ), 'Are you sure you want to Cancel the order?'); ?>
	</li>
</ul>