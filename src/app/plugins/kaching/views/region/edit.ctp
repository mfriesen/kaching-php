<?php $this->pageTitle = "Kaching: Country Maintenance"; ?>

<?php echo $this->element('country/menu', array("country"=>$country,'tab'=>'1')); ?>

<div class="tab-pane padding10">

	<?php echo $form->create('Region', array('action'=>'edit', 'class'=>'inline')); ?>
	
	<?php echo $this->element("region/edit")?>
		
	<?php echo $form->end(array('label'=>"/kaching/img/button-save.png", 'div'=>'span-23 padding10')); ?>
	<div class="clear"></div>
	
</div>