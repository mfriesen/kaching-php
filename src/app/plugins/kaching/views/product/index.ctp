<?php $this->pageTitle = "Kaching: Product Search"; ?>

<div class="tab-pane padding10">
	<?php echo $form->create('Productsearch', array('action'=>'index', 'class'=>'inline')); ?>
	
	<br/>
	<div class="span-21"><h4><strong>Product Search</strong></h4></div>
	<div class="span-3 span-3-padding10 txt-right last"><a href='/kaching/products/view'><img src='/kaching/img/button-new.png' alt='new product'/></a></div>
	
	<?php echo $this->element("product/search-q")?>
	
	<?php echo $this->element("product/search-sort")?>
	
	<?php echo $this->element("product/search-direction")?>
	
	<?php echo $form->end(array('div'=>'span-4 span-4-padding10 txt-right last', "label"=>"/kaching/img/button-search.png")); ?>
	
	<div class="clear">&nbsp;</div>
	
	<?php echo $this->element('product/search-results')?>
	
</div>

<script type="text/javascript">
document.getElementById('q').focus();
</script>