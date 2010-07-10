<?php $this->set("title_for_layout", "Kaching: Product Maintenance") ?>

<?php $id = $this->data['Product']['id']?>
<?php echo $this->element('product/menu', array("plugin"=>"kaching", "product"=>$this->data, 'tab'=>'0')); ?>

<div class="tab-pane">

	<?php echo $form->create('Product', array('action'=>'view', 'class'=>'inline')); ?>
	<?php echo $form->hidden('id');?>
	<div class="span-24"><h4 class='padding10 margin0'><strong>Product Info</strong></h4></div>

	<?php echo $this->element('product/view'); ?>
	
	<?php echo $form->end(array('label'=>"/kaching/img/button-save.png", 'div'=>'span-24 padding10')); ?>
	<div class="clear">&nbsp;</div>

</div>

<?php echo $javascript->link('/kaching/js/jquery.tooltip.js'); ?>
<?php echo $javascript->link('/kaching/js/jquery.image-preview.js'); ?>