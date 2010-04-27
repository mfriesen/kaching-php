<?php $id = isset($product['Product']['id']) ? $product['Product']['id'] : ""; ?>
<?php $productStoreId = isset($this->data['ProductStore']['id']) ? $this->data['ProductStore']['id'] : ""; ?>

<?php echo $form->hidden('ProductStore.id', array('value'=>$productStoreId));?>
<?php echo $form->hidden('ProductStore.product_id', array('value'=>$id));?>

<div class="span-3 txt-right"><label class='txt-right' for="store">Store:</label></div>
<div class="span-20 last">
	<?php echo $form->select("ProductStore.store_id", $stores) ?>
	<?php echo $form->error("ProductStore.store_id") ?>
</div>	
<div class="clear"></div>

<hr/>
<div class="span-11">
	<div class="span-3 txt-right"><label for="retaillevel1">Retail Level 1:</label></div>				
	<div class="span-3 last">
		<?php echo $form->text("ProductStore.retail_level_1", array("size"=>"7")) ?>
		<?php echo $form->error("ProductStore.retail_level_1") ?>
	</div>
	<div class="span-2 txt-right"><label for="discountlevel1">Discount:</label></div>				
	<div class="span-3 last">
		<?php echo $form->text("ProductStore.discount_level_1", array("size"=>"7")) ?>
		<a class="tooltip" title="Apply discount to Retail Level 1. Set to 0 to ignore"><img width='20' height='20' src='/kaching/img/info.png' alt='discount retail level 1'/></a>
		<?php echo $form->error("ProductStore.discount_level_1") ?>
	</div>
	<div class="clear"></div>
	
	<div class="span-3 txt-right"><label for="qtylevel1">Qty Level 1:</label></div>				
	<div class="span-3 last">
		<?php echo $form->text("ProductStore.qty_level_1_start", array("size"=>"7")) ?>
		<?php echo $form->error("ProductStore.qty_level_1_start") ?>
	</div>
	<div class="span-2 txt-center"><label for="toqtylevel1">to</label></div>				
	<div class="span-3 last">
		<?php echo $form->text("ProductStore.qty_level_1_end", array("size"=>"7")) ?>
		<a class="tooltip" title="Purchase Qty range needed to get this pricing. Set to 0 to ignore"><img width='20' height='20' src='/kaching/img/info.png' alt='qty retail level 1'/></a>
		<?php echo $form->error("ProductStore.qty_level_1_end") ?>
	</div>
	<div class="clear"></div>
	
	<div class="span-3 txt-right"><label for="retaillevel2">Retail Level 2:</label></div>				
	<div class="span-3 last">
		<?php echo $form->text("ProductStore.retail_level_2", array("size"=>"7")) ?>
		<?php echo $form->error("ProductStore.retail_level_2") ?>
	</div>
	<div class="span-2 txt-right"><label for="discountlevel2">Discount:</label></div>				
	<div class="span-3 last">
		<?php echo $form->text("ProductStore.discount_level_2", array("size"=>"7")) ?>
		<a class="tooltip" title="Apply discount to Retail Level 2. Set to 0 to ignore"><img width='20' height='20' src='/kaching/img/info.png' alt='discount retail level 2'/></a>
		<?php echo $form->error("ProductStore.discount_level_2") ?>
	</div>
	<div class="clear"></div>
	
	<div class="span-3 txt-right"><label for="qtylevel2">Qty Level 2:</label></div>				
	<div class="span-3 last">
		<?php echo $form->text("ProductStore.qty_level_2_start", array("size"=>"7")) ?>
		<?php echo $form->error("ProductStore.qty_level_2_start") ?>
	</div>
	<div class="span-2 txt-center"><label for="toqtylevel2">to</label></div>				
	<div class="span-3 last">
		<?php echo $form->text("ProductStore.qty_level_2_end", array("size"=>"7")) ?>
		<a class="tooltip" title="Purchase Qty range needed to get this pricing. Set to 0 to ignore"><img width='20' height='20' src='/kaching/img/info.png' alt='qty retail level 2'/></a>
		<?php echo $form->error("ProductStore.qty_level_2_end") ?>
	</div>
	<div class="clear"></div>
	
	<div class="span-3 txt-right"><label for="retaillevel3">Retail Level 3:</label></div>				
	<div class="span-3 last">
		<?php echo $form->text("ProductStore.retail_level_3", array("size"=>"7")) ?>
		<?php echo $form->error("ProductStore.retail_level_3") ?>
	</div>
	<div class="span-2 txt-right"><label for="discountlevel3">Discount:</label></div>				
	<div class="span-3 last">
		<?php echo $form->text("ProductStore.discount_level_3", array("size"=>"7")) ?>
		<a class="tooltip" title="Apply discount to Retail Level 3. Set to 0 to ignore"><img width='20' height='20' src='/kaching/img/info.png' alt='discount retail level 3'/></a>
		<?php echo $form->error("ProductStore.discount_level_3") ?>
	</div>
	<div class="clear"></div>

	<div class="span-3 txt-right"><label for="qtylevel3">Qty Level 3:</label></div>				
	<div class="span-3 last">
		<?php echo $form->text("ProductStore.qty_level_3_start", array("size"=>"7")) ?>
		<?php echo $form->error("ProductStore.qty_level_3_start") ?>
	</div>
	<div class="span-2 txt-center"><label for="toqtylevel3">to</label></div>				
	<div class="span-3 last">
		<?php echo $form->text("ProductStore.qty_level_3_end", array("size"=>"7")) ?>
		<a class="tooltip" title="Purchase Qty range needed to get this pricing. Set to 0 to ignore"><img width='20' height='20' src='/kaching/img/info.png' alt='qty retail level 3'/></a>
		<?php echo $form->error("ProductStore.qty_level_3_end") ?>
	</div>
	<div class="clear"></div>
		
</div>

<div class="span-12 span-12-border-1">
	<div class="span-3 txt-right"><label for="qty">Qty Available:</label></div>
	<div class="span-9 span-9-border-1 last">
		<?php echo $form->text("ProductStore.qty", array("size"=>"5")) ?>
		<a class="tooltip" title="Qty available. Set to -1 for unlimited"><img width='20' height='20' src='/kaching/img/info.png' alt='qty available'/></a>
		<?php echo $form->error("ProductStore.qty") ?>
	</div>	
	<div class="clear"></div>
	
	<?php $activeList = array ('0'=>'Inactive', '1'=>'Active'); ?>
	<div class="span-3 txt-right"><label for="active">Active:</label></div>
	<div class="span-9 span-9-border-1 last">
		<?php echo $form->select("ProductStore.active", $activeList, null, array(), false) ?>
		<?php echo $form->error("ProductStore.active") ?>
	</div>	
	<div class="clear"></div>
	
	<?php $variablePricing = array ('0'=>'No', '1'=>'Yes'); ?>
	<div class="span-3 txt-right"><label for="variable_pricing">Variable Pricing:</label></div>
	<div class="span-9 span-9-border-1 last">
		<?php echo $form->select("ProductStore.variable_pricing", $variablePricing, null, array(), false) ?>
		<a class="tooltip" title="Allow product to have a range of pricing, between retail and discount amounts"><img width='20' height='20' src='/kaching/img/info.png' alt='variable pricing'/></a>
		<?php echo $form->error("ProductStore.variable_pricing") ?>
	</div>	
	<div class="clear"></div>
	
	<div class="span-3 txt-right"><label for="shippingLabel">Charge Shipping:</label></div>
	<div class="span-9 span-9-border-1 last">
		<?php echo $form->checkbox('ProductStore.shipping', array('id'=>'shipping')); ?>
		<a class="tooltip" title="Charge for shipping of this product"><img width='20' height='20' src='/kaching/img/info.png' alt='charge shipping'/></a>
	</div>	
	<div class="clear"></div>
	
	<div class="span-3 txt-right"><label id="tax1label" for="tax1label">Charge Tax1:</label></div>
	<div class="span-9 span-9-border-1 last">
		<?php echo $form->checkbox('ProductStore.tax1', array('id'=>'tax1')); ?>
		<a class="tooltip" title="Charge this tax for this product"><img width='20' height='20' src='/kaching/img/info.png' alt='tax1'/></a>
	</div>	
	<div class="clear"></div>
	
	<div class="span-3 txt-right"><label id="tax2label" for="tax2label">Charge Tax2:</label></div>
	<div class="span-9 span-9-border-1 last">
		<?php echo $form->checkbox('ProductStore.tax2', array('id'=>'tax2')); ?>
		<a class="tooltip" title="Charge this tax for this product"><img width='20' height='20' src='/kaching/img/info.png' alt='tax2'/></a>
	</div>	
	<div class="clear"></div>
</div>

<script type="text/javascript">

	function changeTaxLabel(index) {
		<?php foreach($stores as $key => $store) { ?>
			if (index == <?php echo $key?>) {

				<?php if (strlen($tax1list[$key]) > 0) { ?>
				jQuery("#tax1label").text("<?php echo $tax1list[$key]?>:");
				<?php } else { ?>
				jQuery("#tax1label").text("Charge Tax1:");
				<?php }?>

				<?php if (strlen($tax2list[$key]) > 0) { ?>
				jQuery("#tax2label").text("<?php echo $tax2list[$key]?>:");
				<?php } else { ?>
				jQuery("#tax2label").text("Charge Tax2:");
				<?php } ?>
			}
		<?php } ?>	
	}
	
	jQuery(document).ready(function() {

		var index = jQuery("#ProductStoreStoreId").val();
		changeTaxLabel(index);
		
		jQuery("#ProductStoreStoreId").change(function() {

			var index = jQuery("#ProductStoreStoreId").val();
			changeTaxLabel(index);
		});				
	});
</script>