
<div class="span-3 txt-right"><label class='txt-right' for="number">ID:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Country.id", array("size"=>"4", "maxlength"=>"4")) ?>
	<?php echo $form->error("Country.id") ?>
</div>

<div class="span-3 txt-right"><label class='txt-right' for="number">Name:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Country.name", array("size"=>"40", "maxlength"=>"64")) ?>
	<?php echo $form->error("Country.name") ?>
</div>