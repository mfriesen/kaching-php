<?php $javascript->link('http://www.google.com/jsapi', false)?>
<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<?php $countries = $this->requestAction("/kaching/helpers/get_countries");?>
<?php
if (!empty($countries)) {
	$key = array_slice($countries, 0, 1);
	$regions = $this->requestAction("/kaching/helpers/get_regions/" . key($key));
}
?>

<hr/>
<?php echo $form->create('Helpers', array('action'=>'calculate_shipping', 'class'=>'inline')); ?>

<h3 class='brown margin0'>Calculate Shipping</h3>

<div class="span-4 txt-right"><label class='txt-right' for="country">Country:</label></div>
<div class="span-13 last">
	<?php echo $form->select("Order.shipto_country", $countries, null, array("id"=>"shipto_countries", "empty"=>false)) ?>
	<?php echo $form->error("Order.shipto_country") ?>	
</div>

<div class="span-4 txt-right"><label class='txt-right' for="province">Province / State:</label></div>
<div class="span-13 last">
	<?php echo $form->select("Order.shipto_region", $regions, null, array("id"=>"shipto_regions", "empty"=>false)) ?>
	<?php echo $form->error("Order.shipto_region") ?>
</div>

<div class="span-4 txt-right"><label class='txt-right' for="postal">Postal / Zip Code:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.shipto_postalcode", array("size"=>"30", "maxlength"=>"45")) ?>
	<?php echo $form->error("Order.shipto_postalcode") ?>
</div>

<div class="span-4 txt-right"><label class='txt-right' for="city">City:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.shipto_city", array("size"=>"30", "maxlength"=>"45")) ?>
	<?php echo $form->error("Order.shipto_city") ?>
</div>

<div class="span-4 txt-right"><label class='txt-right' for="city">Shipping Total:</label></div>
<div class="span-13 last">$<span id="shipping_total">0.00</span></div>
<div class="clear"></div>

<?php echo $ajax->submit('/kaching/img/button-submit.png', array('url'=> '/kaching/helpers/calculate_shipping', 'update' => 'shipping_total', 'submitimage'=>"/kaching/img/button-submit.png")) ?>

<?php echo $ajax->observeField('shipto_countries', array('with'=>'Form.serializeElements( $("HelpersCalculateShippingForm").getElements() )','url'=>'/kaching/helpers/update_shipto_region_select','update'=>'shipto_regions')) ?>