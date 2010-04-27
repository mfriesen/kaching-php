<?php $this->pageTitle = "Kaching: Shipping Alias Maintenance"; ?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<?php echo $this->element('shippingzone/menu', array("zone"=>$shippingzone,'tab'=>'2')); ?>

<div class="tab-pane padding10">

	<?php echo $form->create('Shippingalias', array('action'=>'edit', 'class'=>'inline')); ?>
	
	<?php echo $this->element("shippingalias/edit")?>
		
	<?php echo $form->end(array('label'=>"/kaching/img/button-save.png", 'div'=>'span-23 padding10')); ?>
	<div class="clear"></div>
	
</div>

<?php echo $javascript->link('/kaching/js/jquery.tooltip.js'); ?>