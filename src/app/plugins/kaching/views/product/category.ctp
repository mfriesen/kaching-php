<?php $this->set("title_for_layout", "Kaching: Product Category Maintenance") ?>

<?php $id = $this->data['Product']['id']?>
<?php echo $this->element('product/menu', array("plugin"=>"kaching", "product"=>$this->data,'tab'=>'1')); ?>
<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>
<?php echo $this->element('js/treetable', array('plugin'=>'kaching')); ?>

<div class="tab-pane">

	<div class='padding10'>
		<?php $id = $this->data['Product']['id']; ?>
	
		<a id="addcategorylink" href="#"><img src="/kaching/img/button-new.png" alt="Add Category" /></a><br /><br />
		
		<table id='productcategory' class="simple" summary="product categories">
			<tr>
				<th>Category</th>
				<th class='txt-right'>Action</th>
			</tr>
			<?php foreach($this->data['Category'] as $index => $category): ?>
				<?php $productCategoryId = $category['ProductCategory']['id']; ?>
			<tr>
				<td><?php echo h($category['name']); ?></td>
				<td class='txt-right'>
					<?php $l = "Do you want to delete Category " . $category['name'] . "?"; ?>
					<?php echo $ajax->link('delete',array( 'controller' => 'products', 'action' => 'deleteCategory', $id, $productCategoryId), array( 'id'=>"delete_category_$index", 'update' => 'product','complete' => 'location.reload(true);' ), $l); ?>				
				</td>
			</tr>
			<?php endforeach; ?>
		</table>	
		
		<div id='addcategory'>
			<br /><br />
			<h4>Add Category</h4>
			<?php echo $form->create('Product', array('action'=>'addcategory', 'class'=>'inline')); ?>
			<?php echo $form->hidden('ProductCategory.product_id', array('value'=>$id));?>
					
			<?php echo $this->element("product/category-table")?>
			
			<br />
			<?php echo $form->end(array('label'=>"/kaching/img/button-ok.png", 'div'=>'span-5')); ?>
			<div class="clear">&nbsp;</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	jQuery(document).ready(function() {
		jQuery("#categoryTable").treeTable({});
		jQuery("#addcategory").hide();
		jQuery("a#addcategorylink").click(function () {
			jQuery("#addcategory").show();
			return true;
		});
	});
</script>
