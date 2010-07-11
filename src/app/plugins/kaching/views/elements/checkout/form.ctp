<!-- Order's Store Id -->
<?php $store_id = $cart->store_id($this->data) ?>

<!-- Store Holidays -->
<?php $holidays = $this->requestAction("/kaching/helpers/get_holidays/$store_id") ?>

<?php $countries = $this->requestAction("/kaching/helpers/get_countries") ?>
<?php
if (!empty($countries)) {
	$key = array_slice($countries, 0, 1);
	$regions = $this->requestAction("/kaching/helpers/get_regions/" . key($key));
}
?>

<h3 class='margin0'>Bill To</h3>
<div class="span-4 txt-right"><label class='txt-right' for="billto_email">Email:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.billto_email", array("size"=>"30", "maxlength"=>"30")) ?>
	<?php echo $form->error("Order.billto_email") ?>
</div>	
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="confirmemail">Confirm Email:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.email_confirm", array("size"=>"30", "maxlength"=>"30")) ?>
	<?php echo $form->error("Order.email_confirm") ?>
</div>	
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="fullName">Name:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.billto_name", array("size"=>"30", "maxlength"=>"30")) ?>
	<?php echo $form->error("Order.billto_name") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="address">Address:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.billto_address", array("size"=>"30", "maxlength"=>"45")) ?>
	<?php echo $form->error("Order.billto_address") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="city">City:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.billto_city", array("size"=>"30", "maxlength"=>"45")) ?>
	<?php echo $form->error("Order.billto_city") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="province">Province/State:</label></div>
<div class="span-13 last">
	<?php echo $form->select("Order.billto_region", $regions, null, array("id"=>"billto_regions", "empty"=>false)) ?>
	<?php echo $form->error("Order.billto_region") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="postal">Postal / Zip Code:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.billto_postalcode", array("size"=>"30", "maxlength"=>"45")) ?>
	<?php echo $form->error("Order.billto_postalcode") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="country">Country:</label></div>
<div class="span-13 last">
	<?php echo $form->select("Order.billto_country", $countries, null, array("id"=>"billto_countries", "empty"=>false)) ?>
	<?php echo $form->error("Order.billto_country") ?>
</div>
<div class="clear">&nbsp;</div>

<h3 class='margin0'>Shipping To</h3>

<div class="span-4 txt-right"><label class='txt-right' for="fullName">Name:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.shipto_name", array("size"=>"30", "maxlength"=>"45")) ?>
	<?php echo $form->error("Order.shipto_name") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="address">Address:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.shipto_address", array("size"=>"30", "maxlength"=>"45")) ?>
	<?php echo $form->error("Order.shipto_address") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="city">City:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.shipto_city", array("size"=>"30", "maxlength"=>"45")) ?>
	<?php echo $form->error("Order.shipto_city") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="province">Province / State:</label></div>
<div class="span-13 last">
	<?php echo $form->select("Order.shipto_region", $regions, null, array("id"=>"shipto_regions", "empty"=>false)) ?>
	<?php echo $form->error("Order.shipto_region") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="postal">Postal / Zip Code:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.shipto_postalcode", array("size"=>"30", "maxlength"=>"45")) ?>
	<?php echo $form->error("Order.shipto_postalcode") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="country">Country:</label></div>
<div class="span-13 last">
	<?php echo $form->select("Order.shipto_country", $countries, null, array("id"=>"shipto_countries", "empty"=>false)) ?>
	<?php echo $form->error("Order.shipto_country") ?>	
</div>
<div class="clear">&nbsp;</div>

<h3 class='margin0'>Payment Information</h3>
<?php $paymentTypes = array ( 'american express'=>'American Express', 'mastercard'=>'MasterCard', 'visa'=>'VISA'); ?>
<?php $paymentType = isset($this->data['Order']['credit_card']) ? $this->data['Order']['credit_card'] : "" ;?>
<div class="span-4 txt-right"><label class='txt-right' for="creditcard">Credit Card Type:</label></div>
<div class="span-13 last">
	<?php echo $form->select("Order.credit_card", $paymentTypes, $paymentType, array("empty"=>false)) ?>
	<?php echo $form->error("Order.credit_card") ?>
</div>	
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="creditcardnumber">Credit Card:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.credit_card_number", array("size"=>"16", "maxlength"=>"16")) ?>
	&nbsp;<span class='error-message'>(numbers only)</span>
	<?php echo $form->error("Order.credit_card_number") ?>
</div>	
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="expirydate">Expiry Date:</label></div>
<div class="span-13 last">
	<?php echo $form->text("Order.credit_card_expiry", array("size"=>"4", "maxlength"=>"4")) ?>
	&nbsp;<span class='error-message'>(mmyy)</span>
	<?php echo $form->error("Order.credit_card_expiry") ?>
</div>	
<div class="clear"></div>

<div class="span-3">&nbsp;</div>
<div class="span-19 last">
	<?php echo $form->checkbox("Order.newsletter") ?>&nbsp;Sign up for Newsletter (billto_email address will be added to Mailinglist table)
</div>
<div class="clear"></div>

<?php echo $ajax->observeField('shipto_countries', array('with'=>'Form.serializeElements( $("CheckoutIndexForm").getElements() )','url'=>'/kaching/helpers/update_shipto_region_select','update'=>'shipto_regions')) ?>
<?php echo $ajax->observeField('billto_countries', array('with'=>'Form.serializeElements( $("CheckoutIndexForm").getElements() )','url'=>'/kaching/helpers/update_billto_region_select','update'=>'billto_regions')) ?>