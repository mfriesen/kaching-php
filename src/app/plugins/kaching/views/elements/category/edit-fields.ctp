<?php echo $form->hidden('id');?>

<div class="span-3 txt-right"><label class='txt-right' for="name">Parent Category:</label></div>
<div class="span-20 last">
	<?php echo $form->select("Category.parent_id", $categories) ?>
	<a class="tooltip" title="Support for unlimited Sub Categories. Sets the Parent for this Category.">
		<img width='20' height='20' src='/kaching/img/info.png' alt='category parent'/>
	</a>	
	<?php echo $form->error("Category.parent_id") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="name">Name:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Category.name", array("size"=>"40")) ?>
	<?php echo $form->error("Category.name") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="name">Description:</label></div>
<div class="span-20 last">
	<?php echo $form->textarea("Category.description", array('cols'=>"55", 'rows'=>"10")) ?>
	<?php echo $form->error("Category.description") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="url">Page:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Category.page", array("size"=>"40")) ?>
	<a class="tooltip" title="Url friendly name for Category.">
		<img width='20' height='20' src='/kaching/img/info.png' alt='category page'/>
	</a>
	<?php echo $form->error("Category.page") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="active">Active:</label></div>
<div class="span-20 last">
	<?php echo $form->checkbox("Category.active") ?>
	<?php echo $form->error("Category.active") ?>
</div>
<div class="clear"></div>