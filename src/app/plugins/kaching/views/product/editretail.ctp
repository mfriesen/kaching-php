<?php $this->pageTitle = "Kaching: Product Retail Maintenance"; ?>

<?php echo $this->element('product/menu', array("plugin"=>"kaching", "product"=>$product,'tab'=>'2')); ?>

<div class="tab-pane">
	<br />
	<?php echo $form->create('Product', array('action'=>'editretail', 'class'=>'inline')); ?>
	
	<div class="span-12 span-12-padding10"><h4 class='padding10 margin0'><strong>Product Retail</strong></h4></div>
	<div class="span-12 span-12-padding10 txt-right last"><a id="help" href="/kaching/products/help/help_retail"><img src='/kaching/img/question.png' alt='Product Retail Help'/></a></div>
	<div class="clear"></div>

	<?php echo $this->element('product/editretail'); ?>
	
	<?php echo $form->end(array('label'=>"/kaching/img/button-save.png", 'div'=>'span-24 padding10')); ?>
	<div class="clear">&nbsp;</div>

</div>

<?php echo $javascript->link('/kaching/js/jquery.tooltip.js'); ?>
<?php echo $this->element("js/fancybox", array("plugin"=>"kaching"))?>
<?php echo $this->element("js/help", array("plugin"=>"kaching"))?>