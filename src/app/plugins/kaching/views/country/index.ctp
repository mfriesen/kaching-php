<?php $this->set("title_for_layout", "Kaching: Country Maintenance") ?>

<div class="tab-pane padding10">
	
	<br />	
	<div class="span-16"><h4><strong>Shipping Countries</strong></h4></div>
	<div class="txt-right">
		<a href="/kaching/countries/edit/" title="Add Country"><img src='/kaching/img/button-new.png' alt='Add Country'/></a>
		<a id="help" href="/kaching/countries/help"><img src='/kaching/img/question.png' alt='Shipping Country Help'/></a>
	</div>
	<div class="clear">&nbsp;</div>
	
	<?php echo $this->element("country/search-table")?>
	
</div>

<?php echo $this->element("js/fancybox", array("plugin"=>"kaching"))?>
<?php echo $this->element("js/help", array("plugin"=>"kaching"))?>