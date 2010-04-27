<?php $this->pageTitle = "Kaching Promotion Coupons"; ?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<div class="tab-pane padding10">
	<br />
	<div class="span-16"><h4><strong>Coupons</strong></h4></div>
	<div class="span-8 span-8-padding10 txt-right last">
		<a href="/kaching/coupons/edit" title="Add Coupon"><img src='/kaching/img/button-new.png' alt='Add Coupon' /></a>
	</div>
	
	<?php echo $this->element("coupon/search-table")?>

</div>