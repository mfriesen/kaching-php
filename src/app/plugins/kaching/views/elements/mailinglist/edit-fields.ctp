<?php echo $form->hidden('id');?>

<div class="span-3 txt-right"><label class='txt-right' for="email">Email:</label></div>
<div class="span-5 last">
	<?php echo $form->text("Mailinglist.email", array("size"=>"40")) ?>
	<?php echo $form->error("Mailinglist.email") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="name">Name:</label></div>
<div class="span-5 last">
	<?php echo $form->text("Mailinglist.name", array("size"=>"40")) ?>
	<?php echo $form->error("Mailinglist.name") ?>
</div>
<div class="clear"></div>
