<?php echo $this->element('store/menu', array("store"=>$this->data,'tab'=>'0')); ?>

<div class="tab-pane padding10">

	<?php echo $form->create('Store', array('action'=>'edit', 'class'=>'inline')); ?>
	<?php echo $this->element("store/edit")?>
		
	<?php echo $form->end(array('label'=>"/kaching/img/button-save.png", 'div'=>'span-23 padding10')); ?>
	<div class="clear"></div>
	
</div>

<?php echo $javascript->link('/kaching/js/jquery.tooltip.js'); ?>