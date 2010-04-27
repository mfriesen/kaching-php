<?php $this->pageTitle = "Kaching Store Maintenance"; ?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<div class="tab-pane padding10">
	<br />	
	<div class="span-16"><h4><strong>Store Listing</strong></h4></div>
	<div class="span-8 span-8-padding10 last txt-right">
	<a href="/kaching/stores/edit" title="Add Store"><img src='/kaching/img/button-new.png' alt='Add Store'/></a>
	</div>
	
	<?php echo $this->element('store/search-table'); ?>
	
</div>