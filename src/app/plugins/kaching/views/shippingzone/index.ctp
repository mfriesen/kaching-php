<?php $this->pageTitle = "Kaching Store Maintenance"; ?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<div class="tab-pane padding10">
	<br />	
	<div class="span-16"><h4><strong>Shipping Zones</strong></h4></div>
	<div class="span-8 span-8-padding10 last txt-right">
		<a href="/kaching/shippingzones/edit" title="Add Zone"><img src='/kaching/img/button-new.png' alt='Add Shipping Zone'/></a>
		<a id="help" href="/kaching/shippingzones/help"><img src='/kaching/img/question.png' alt='Shippingzone Help'/></a>
	</div>
	
	<?php echo $this->element('shippingzone/search-table'); ?>
	
</div>

<?php echo $this->element("js/fancybox", array("plugin"=>"kaching"))?>
<?php echo $this->element("js/help", array("plugin"=>"kaching"))?>