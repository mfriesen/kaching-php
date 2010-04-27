<?php echo $form->hidden('id');?>

<div class="span-4 txt-right"><label class='txt-right' for="store">Store:</label></div>
<div class="span-19 last">
	<?php echo $form->select("Coupon.store_id", $stores) ?>
	<?php echo $form->error("Coupon.store_id") ?>
</div>	
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="name">Title:</label></div>
<div class="span-19 last">
	<?php echo $form->text("Coupon.title", array("size"=>"40")) ?>
	<?php echo $form->error("Coupon.title") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="name">Description:</label></div>
<div class="span-19 last">
	<?php echo $form->textarea("Coupon.description", array('cols'=>"45", 'rows'=>"3")) ?>
	<?php echo $form->error("Coupon.description") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="name">Percent (%):</label></div>
<div class="span-19 last">
	<?php echo $form->text("Coupon.percent", array("size"=>"5")) ?>
	<a class="tooltip" title="Example: For 7% discount, enter 7"><img width='20' height='20' src='/kaching/img/info.png' alt='coupon percent'/></a>
	<?php echo $form->error("Coupon.percent") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="name">Shipping Discount (%):</label></div>
<div class="span-19 last">
	<?php echo $form->text("Coupon.shipping_percent", array("size"=>"5")) ?>
	<a class="tooltip" title="Example: For 7% discount enter 7"><img width='20' height='20' src='/kaching/img/info.png' alt='shipping percent'/></a>
	<?php echo $form->error("Coupon.shipping_percent") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="name">Amount ($):</label></div>
<div class="span-19 last">
	<?php echo $form->text("Coupon.amount", array("size"=>"5")) ?>
	<a class="tooltip" title="Dollar amount discount (0 to ignore)"><img width='20' height='20' src='/kaching/img/info.png' alt='coupon amount'/></a>
	<?php echo $form->error("Coupon.amount") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="name">Min Amount ($):</label></div>
<div class="span-7 last">
	<?php echo $form->text("Coupon.min_amount", array("size"=>"5")) ?>
	<a class="tooltip" title="Minimum Amount for Coupon (0 to ignore)"><img width='20' height='20' src='/kaching/img/info.png' alt='min coupon amount'/></a>
	<?php echo $form->error("Coupon.min_amount") ?>
</div>
<div class="clear"></div>

<?php $start = isset($this->data['Coupon']['start']) ? $date->formatDate($this->data['Coupon']['start'], "Y-m-d") : ""; ?>
<div class="span-4 txt-right"><label class='txt-right' for="name">Start Date:</label></div>
<div class="span-19 last">
	<?php echo $form->text("Coupon.start", array("size"=>"10", "maxlength"=>"10", "readonly"=>true, "value"=>$start)) ?>
	<?php echo $form->error("Coupon.start") ?>
</div>
<div class="clear"></div>

<?php $end = isset($this->data['Coupon']['end']) ? $date->formatDate($this->data['Coupon']['end'], "Y-m-d") : ""; ?>
<div class="span-4 txt-right"><label class='txt-right' for="name">End Date:</label></div>
<div class="span-19 last">
	<?php echo $form->text("Coupon.end", array("size"=>"10", "maxlength"=>"10", "readonly"=>true, "value"=>$end)) ?>
	<?php echo $form->error("Coupon.end") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="name">Conditions:</label></div>
<div class="span-19 last">
	<?php echo $form->textarea("Category.conditions", array('cols'=>"45", 'rows'=>"6")) ?>
	<?php echo $form->error("Category.conditions") ?>
</div>
<div class="clear"></div>

<div class="span-4 txt-right"><label class='txt-right' for="name">Discount Code:</label></div>
<div class="span-19 last">
	<?php echo $form->text("Coupon.code", array("size"=>"16")) ?>
	<a class="tooltip" title="Website Coupon Code"><img width='20' height='20' src='/kaching/img/info.png' alt='coupon code'/></a>
	<?php echo $form->error("Coupon.code") ?>
</div>
<div class="clear"></div>