<?php echo $form->create('Checkout', array('action'=>'complete', 'class'=>'inline')); ?>

<div class='txt-right'><?php echo $this->element('checkout/menu', array('plugin'=>'kaching', 'selected'=>'Review')); ?></div>

<h2 class='margin0'>Order Summary</h2>

<?php echo $this->element("checkout/form-review", array('plugin'=>'kaching')); ?>

<?php echo $this->element('order/items', array('plugin'=>'kaching')) ?>

<br />
<?php echo $form->end(array('label'=>"/kaching/img/button-complete-single.png")); ?>