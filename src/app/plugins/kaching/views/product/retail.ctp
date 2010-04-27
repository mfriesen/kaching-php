<?php $this->pageTitle = "Kaching: Product Retail Maintenance"; ?>

<?php $id = $this->data['Product']['id']?>
<?php echo $this->element('product/menu', array("plugin"=>"kaching", "product"=>$this->data, 'tab'=>'2')); ?>
<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<div class="tab-pane">
	<div class='padding10'>
		<?php echo $this->element('product/retail'); ?>
	</div>
</div>
