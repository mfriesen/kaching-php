<?php $this->set("title_for_layout", "Kaching: Country Maintenance") ?>

<?php echo $this->element('country/menu', array("country"=>$this->data,'tab'=>'0')); ?>

<div class="tab-pane padding10">

	<?php echo $form->create('Country', array('action'=>'edit', 'class'=>'inline')); ?>
	
	<?php echo $this->element("country/edit")?>
		
	<?php echo $form->end(array('label'=>"/kaching/img/button-save.png", 'div'=>'span-23 padding10')); ?>
	<div class="clear"></div>
	
</div>