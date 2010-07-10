<?php $this->set("title_for_layout", "Kaching Category Maintenance") ?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>
<?php echo $this->element('js/treetable', array('plugin'=>'kaching')); ?>

<div class="tab-pane padding10">
	<br />
	<div class="span-16"><h4><strong>Categories Listing</strong></h4></div>
	<div class="span-8 span-8-padding10 txt-right last">
	<a href="/kaching/categories/edit" title="Add Category"><img src='/kaching/img/button-new.png' alt='Add Category'/></a>
	</div>
	
	<?php echo $this->element('category/category-table'); ?>
	
	<?php echo $this->element('paginator-links'); ?>
</div>


<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#categoryTable").treeTable({
		});		
	});
</script>