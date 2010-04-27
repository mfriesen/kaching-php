
<?php echo $form->hidden('id');?>
<?php echo $form->hidden('country_id');?>

<div class="span-3 txt-right"><label class='txt-right' for="number">Name:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Region.name", array("size"=>"40", "maxlength"=>"64")) ?>
	<?php echo $form->error("Region.name") ?>
</div>