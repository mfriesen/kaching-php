<?php echo $form->hidden('id');?>

<h4 class='margin0'><strong>Store Info</strong></h4>
<div class="span-3 txt-right"><label class='txt-right' for="number">Number:</label></div>
<div class="span-9">
	<?php echo $form->text("Store.number", array("size"=>"5", "maxlength"=>"5")) ?>
	<a class="tooltip" title="Required Field, First Store you create must be Number 1">
		<img width='20' height='20' src='/kaching/img/info.png' alt='store number'/>
	</a>
	<?php echo $form->error("Store.number") ?>
</div>

<div class="span-3 txt-right"><label class='txt-right' for="name">Name:</label></div>
<div class="span-9 span-9-padding10 last">
	<?php echo $form->text("Store.name", array("size"=>"38", "maxlength"=>"64")) ?>
	<?php echo $form->error("Store.name") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="website">Website:</label></div>
<div class="span-9">
	<?php echo $form->text("Store.website", array("size"=>"40", "maxlength"=>"64")) ?>
	<?php echo $form->error("Store.website") ?>
</div>

<div class="span-3 txt-right"><label class='txt-right' for="email">Email:</label></div>
<div class="span-9 span-9-padding10 last">
	<?php echo $form->text("Store.email", array("size"=>"38", "maxlength"=>"64")) ?>
	<?php echo $form->error("Store.email") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="address">Address:</label></div>
<div class="span-9">
	<?php echo $form->text("Store.address", array("size"=>"40", "maxlength"=>"64")) ?>
	<?php echo $form->error("Store.address") ?>
</div>
<div class="span-3 txt-right"><label class='txt-right' for="city">City:</label></div>
<div class="span-9 span-9-padding10 last">
	<?php echo $form->text("Store.city", array("size"=>"38", "maxlength"=>"64")) ?>
	<?php echo $form->error("Store.city") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="province">Province / State:</label></div>
<div class="span-9">
	<?php echo $form->text("Store.province", array("size"=>"40", "maxlength"=>"64")) ?>
	<?php echo $form->error("Store.province") ?>
</div>
<div class="span-3 txt-right"><label class='txt-right' for="city">Postal / Zip Code:</label></div>
<div class="span-9 span-9-padding10 last">
	<?php echo $form->text("Store.postalcode", array("size"=>"38", "maxlength"=>"64")) ?>
	<?php echo $form->error("Store.postalcode") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="phoneNumber">Phone Number:</label></div>
<div class="span-9">
	<?php echo $form->text("Store.phonenumber", array("size"=>"20", "maxlength"=>"20")) ?>
	<?php echo $form->error("Store.phonenumber") ?>
</div>
<div class="span-3 txt-right"><label class='txt-right' for="tollfree">Toll Free:</label></div>
<div class="span-8 last">
	<?php echo $form->text("Store.tollfree", array("size"=>"20", "maxlength"=>"20")) ?>
	<?php echo $form->error("Store.tollfree") ?>
</div>
<div class="clear"></div>