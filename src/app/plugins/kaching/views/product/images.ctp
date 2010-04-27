<?php $this->pageTitle = "Kaching: Product Images Maintenance"; ?>

<?php if (isset($this->data['Product']['id'])) { ?>

<?php $id = $this->data['Product']['id']?>
<?php echo $this->element('product/menu', array("plugin"=>"kaching", "product"=>$this->data, 'tab'=>'3')); ?>

<?php } ?>

<div class="tab-pane">

	<div class="span-24"><h4 class='padding10 margin0'><strong>Upload Product Images</strong></h4></div>
	
	<div class='padding10'><?php echo $this->element('product/images'); ?></div>
</div>