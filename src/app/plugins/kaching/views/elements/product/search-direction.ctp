<?php $direction = array ('asc'=>'Asc', 'desc'=>'Desc'); ?>
<div class="span-4">
	<label for="direction">Direction:</label>
	<?php echo $form->select("Productsearch.direction", $direction, null, array(), false) ?>
	<?php echo $form->error("Productsearch.direction") ?>
</div>