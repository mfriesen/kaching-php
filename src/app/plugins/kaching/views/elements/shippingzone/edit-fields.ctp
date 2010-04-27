
<?php echo $form->hidden('id');?>

<div class="span-3 txt-right"><label class='txt-right' for="number">Label:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Shippingzone.label", array("size"=>"40", "maxlength"=>"64")) ?>
	<?php echo $form->error("Shippingzone.label") ?>
</div>

<div class="span-3 txt-right"><label class='txt-right' for="name">Description:</label></div>
<div class="span-20 last">
	<?php echo $form->textarea("Shippingzone.description", array('cols'=>"55", 'rows'=>"10")) ?>
	<?php echo $form->error("Shippingzone.description") ?>
</div>
<div class="clear"></div>

<script type="text/javascript">
document.getElementById('ShippingzoneLabel').focus();
</script>