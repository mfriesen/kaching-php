<?php $this->set("title_for_layout", "Kaching: Shipping Zones Maintenance") ?>

<?php echo $this->element('shippingzone/menu', array("zone"=>$this->data,'tab'=>'0')); ?>

<div class="tab-pane padding10">

	<?php echo $form->create('Shippingzone', array('action'=>'edit', 'class'=>'inline')); ?>
	
	<?php echo $this->element("shippingzone/edit")?>
		
	<?php echo $form->end(array('label'=>"/kaching/img/button-save.png", 'div'=>'span-23 padding10')); ?>
	<div class="clear"></div>
	
</div>