<?php echo $form->hidden('id');?>

<div class="span-4 txt-right"><label class='txt-right' for="name">Name:</label></div>
<div class="span-19 last">
	<?php echo $form->text("Group.name", array("size"=>"40")) ?>
	<?php echo $form->error("Group.name") ?>
</div>
<div class="clear"></div>