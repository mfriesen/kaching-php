<?php echo $form->create('Checkout', array('action'=>'complete', 'class'=>'inline')); ?>

<div class='txt-right'><?php echo $this->element('checkout/menu', array('plugin'=>'kaching', 'selected'=>'Complete')); ?></div>

<h2 class='margin0'>Order Complete</h2>

<?php echo $this->element("checkout/form-review", array('plugin'=>'kaching')); ?>

<?php echo $this->element('order/items', array('plugin'=>'kaching')) ?>

<?php echo $form->end(); ?>