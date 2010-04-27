<hr />
<h4 class='margin0'><strong>Taxes</strong></h4> 

<div class="span-3 txt-right"><label class='txt-right' for="tax1name">Tax 1 Name:</label></div>
<div class="span-9">
	<?php echo $form->text("Store.tax1name", array("size"=>"40", "maxlength"=>"64")) ?>
	<?php echo $form->error("Store.tax1name") ?>
</div>
<div class="span-3 txt-right"><label class='txt-right' for="tax1">Tax 1 (%):</label></div>
<div class="span-9 span-9-padding10 last">
	<?php echo $form->text("Store.tax1", array("size"=>"5")) ?>
	<a class="tooltip" title="Example: For 7% tax, enter 7"><img width='20' height='20' src='/kaching/img/info.png' alt='tax1'/></a>
	<?php echo $form->error("Store.tax1") ?>
</div>
<div class="clear"></div>
   
<div class="span-3 txt-right"><label class='txt-right' for="tax2name">Tax 2 Name:</label></div>
<div class="span-9">
	<?php echo $form->text("Store.tax2name", array("size"=>"40", "maxlength"=>"64")) ?>
	<?php echo $form->error("Store.tax2name") ?>
</div>
<div class="span-3 txt-right"><label class='txt-right' for="tax2">Tax 2 (%):</label></div>
<div class="span-9 span-9-padding10 last">
	<?php echo $form->text("Store.tax2", array("size"=>"5")) ?>
	<a class="tooltip" title="Example: For 7% tax, enter 7"><img width='20' height='20' src='/kaching/img/info.png' alt='tax2'/></a>
	<?php echo $form->error("Store.tax2") ?>
</div>
<div class="clear"></div>

<div class="span-3 txt-right"><label class='txt-right' for="servicefee">Service Fee ($):</label></div>
<div class="span-9">
	<?php echo $form->text("Store.service_fee", array("size"=>"5")) ?>
	<a class="tooltip" title="Service fee will apply to entire order"><img width='20' height='20' src='/kaching/img/info.png' alt='tax1'/></a>
	<?php echo $form->error("Store.service_fee") ?>
</div>
<div class="span-3 txt-right"><label class='txt-right' for="shippingtax">Shipping Tax (%):</label></div>
<div class="span-9 span-9-padding10 last">
	<?php echo $form->text("Store.shipping_tax", array("size"=>"5")) ?>
	<a class="tooltip" title="Example: For 7% tax, enter 7"><img width='20' height='20' src='/kaching/img/info.png' alt='shipping tax'/></a>
	<?php echo $form->error("Store.shipping_tax") ?>
</div>
<div class="clear"></div>