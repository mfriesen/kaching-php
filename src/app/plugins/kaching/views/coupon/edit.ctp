<script type="text/javascript">
	jQuery(document).ready(function()
	{	
		jQuery("#CouponStart").datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, showOn: 'button', buttonImage: '/kaching/img/calendar_button_blue.gif', buttonImageOnly: true });
		jQuery("#CouponEnd").datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, showOn: 'button', buttonImage: '/kaching/img/calendar_button_blue.gif', buttonImageOnly: true });		
	});	
</script>

<div class="tab-pane padding10">

<a href="/kaching/coupons">Back to Coupons</a>
<br /><br />

	<?php echo $form->create('Coupon', array('action'=>'edit', 'class'=>'inline')); ?>
	<?php echo $this->element("coupon/edit")?>
		
	<?php echo $form->end(array('label'=>"/kaching/img/button-save.png", 'div'=>'span-23 padding10')); ?>
	<div class="clear"></div>
	
</div>

<?php echo $javascript->link('/kaching/js/jquery.tooltip.js'); ?>