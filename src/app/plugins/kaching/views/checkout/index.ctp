<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<?php echo $form->create('Checkout', array('action'=>'index', 'class'=>'inline')); ?>

<!-- This hidden var is optional -->
<!-- Example on how to override where to go on successful validation -->
<input type='hidden' name='data[url]' value='/kaching/checkouts/review'/>

<div class='txt-right'><?php echo $this->element('checkout/menu', array('plugin'=>'kaching', 'selected'=>'Checkout')); ?></div>

<?php echo $this->element("checkout/form", array('plugin'=>'kaching')); ?>

<?php echo $form->end(array('label'=>"/kaching/img/button-review.png")); ?>