
<div class="span-12">
	<h3 class='margin0'>Bill To</h3>
	<div class="span-4 txt-right"><label class='txt-right' for="billto_email">Email:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['billto_email']?></div>
	<div class="clear"></div>
		
	<div class="span-4 txt-right"><label class='txt-right' for="fullName">Name:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['billto_name']?></div>
	<div class="clear"></div>
	
	<div class="span-4 txt-right"><label class='txt-right' for="address">Address:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['billto_address']?></div>
	<div class="clear"></div>
	
	<div class="span-4 txt-right"><label class='txt-right' for="city">City:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['billto_city']?></div>
	<div class="clear"></div>
	
	<div class="span-4 txt-right"><label class='txt-right' for="province">Region:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['billto_region']?></div>
	<div class="clear"></div>

	<div class="span-4 txt-right"><label class='txt-right' for="province">Postal / Zip Code:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['billto_postalcode']?></div>
	<div class="clear"></div>
	
	<div class="span-4 txt-right"><label class='txt-right' for="country">Country:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['billto_country']?></div>
	<div class="clear">&nbsp;</div>
</div>

<div class="span-12 last">
	<h3 class='margin0'>Shipping To</h3>
	
	<div class="span-4 txt-right"><label class='txt-right' for="fullName">Name:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['shipto_name']?></div>
	<div class="clear"></div>
	
	<div class="span-4 txt-right"><label class='txt-right' for="address">Address:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['shipto_address']?></div>
	<div class="clear"></div>
	
	<div class="span-4 txt-right"><label class='txt-right' for="city">City:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['shipto_city']?></div>
	<div class="clear"></div>
	
	<div class="span-4 txt-right"><label class='txt-right' for="province">Region:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['shipto_region']?></div>
	<div class="clear"></div>

	<div class="span-4 txt-right"><label class='txt-right' for="province">Postal / Zip Code:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['shipto_postalcode']?></div>
	<div class="clear"></div>
		
	<div class="span-4 txt-right"><label class='txt-right' for="country">Country:</label></div>
	<div class="span-8 last"><?php echo $this->data['Order']['shipto_country']?></div>
	<div class="clear">&nbsp;</div>
</div>
<div class="clear"></div>

<h3 class='margin0'>Payment Information</h3>
<div class="span-4 txt-right"><label class='txt-right' for="creditcard">Credit Card Type:</label></div>
<div class="span-8 last"><?php echo ucwords($this->data['Order']['credit_card'])?></div>	
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="creditcardnumber">Credit Card:</label></div>
<div class="span-8 last">
	<?php echo chunk_split ($this->data['Order']['credit_card_number'], 4,' ') ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="expirydate">Expiry Date:</label></div>
<div class="span-8 last"><?php echo $this->data['Order']['credit_card_expiry']?></div>	
<div class="clear"></div>