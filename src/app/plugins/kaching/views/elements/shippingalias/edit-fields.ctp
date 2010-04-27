<?php echo $form->hidden('id');?>
<?php echo $form->hidden('shippingzone_id');?>

<?php $countries = $this->requestAction("/kaching/helpers/get_countries");?>
<?php
if (!empty($countries)) {
	$key = array_slice($countries, 0, 1);
	$regions = $this->requestAction("/kaching/helpers/get_regions/" . key($key));
}
?>
			
<div class="span-3 txt-right"><label class='txt-right' for="country">Country:</label></div>
<div class="span-20 last">
	<?php echo $form->select("Shippingalias.country", $countries, null, array("id"=>"countries"), false) ?>
	<?php echo $form->error("Shippingalias.country") ?>
</div>

<div class="span-3 txt-right"><label class='txt-right' for="region">Region:</label></div>
<div class="span-20 last">
	<?php echo $form->select("Shippingalias.region", $regions, null, array("id"=>"regions"), false) ?>
	<?php echo $form->error("Shippingalias.region") ?>
</div>

<div class="span-3 txt-right"><label class='txt-right' for="postalcode">Postal / Zip Code:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Shippingalias.postalcode", array("size"=>"40", "maxlength"=>"64")) ?>
	<a class="tooltip" title="Postal / Zip code field is optional">
		<img width='20' height='20' src='/kaching/img/info.png' alt='shipping alias postal / zip code'/>
	</a>
	<?php echo $form->error("Shippingalias.postalcode") ?>
</div>

<div class="span-3 txt-right"><label class='txt-right' for="city">City:</label></div>
<div class="span-20 last">
	<?php echo $form->text("Shippingalias.city", array("size"=>"40", "maxlength"=>"64")) ?>
	<a class="tooltip" title="City field is optional">
		<img width='20' height='20' src='/kaching/img/info.png' alt='shipping alias city'/>
	</a>
	<?php echo $form->error("Shippingalias.city") ?>
</div>

<?php echo $ajax->observeField('countries', array('with'=>'Form.serializeElements( $("ShippingaliasEditForm").getElements() )','url'=>'update_region_select','update'=>'regions')) ?>