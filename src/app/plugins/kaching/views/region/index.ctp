<?php $this->pageTitle = "Kaching: Region Maintenance"; ?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<?php echo $this->element('country/menu', array("country"=>$this->data,'tab'=>'1')); ?>

<?php $country_id = $this->data['Country']['id']?>

<div class="tab-pane padding10">
	
	<div class="txt-right">
		<a href="/kaching/regions/edit/<?php echo $country_id?>" title="Add Region"><img src='/kaching/img/button-new.png' alt='Add Region'/></a>
	</div>
	<div class="clear">&nbsp;</div>
	
	<?php echo $this->element("region/table")?>
	
</div>