<?php echo $form->hidden('id') ?>
<?php echo $form->hidden('Shippingamount.shippingzone_id', array('value'=>$shippingzone['Shippingzone']['id'])) ?>
  		
<div class="column span-3 txt-right"><label class='txt-right' for="name">Amount ($):</label></div>
<div class="column span-15 last">
	<?php echo $form->text("Shippingamount.amount", array("size"=>"5")) ?>
	<?php echo $form->error("Shippingamount.amount") ?>
</div>
<div class="clear"></div>

<div class="column span-3 txt-right"><label class='txt-right' for="name">Weight:</label></div>
<div class="column span-15 last">
	<?php echo $form->text("Shippingamount.weight", array("size"=>"5")) ?>
	<a class="tooltip" title="Set to 0 for flat rating shipping">
		<img width='20' height='20' src='/kaching/img/info.png' alt='shipping weight'/>
	</a>
	<?php echo $form->error("Shippingamount.weight") ?>
</div>
<div class="clear"></div>

<script type="text/javascript">
document.getElementById('ShippingamountAmount').focus();
</script>