<?php $sortBy = array ('title'=>'Title', 'number'=>'Number', 'inserted_date'=>'Inserted Date', 'modified_date'=>'Modified Date'); ?>
<div class="span-5">
	<label for="Sort_By">Sort By:</label>
	<?php echo $form->select("Productsearch.sort", $sortBy, null, array("empty"=>false)) ?>
</div>