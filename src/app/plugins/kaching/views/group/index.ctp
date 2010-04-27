<?php $this->pageTitle = "Kaching Group Maintenance"; ?>

<?php echo $this->element('js/prototype', array('plugin'=>'kaching')); ?>

<div class="tab-pane padding10">
	<?php echo $form->create('Groups', array('action'=>'search', 'class'=>'inline')); ?>
	
	<br />
	<div class="span-16"><h4><strong>Groups</strong></h4></div>
	<div class="span-8 span-8-padding10 txt-right last">
		<a href="/kaching/groups/edit" title="Add Group"><img src='/kaching/img/button-new.png' alt='Add Group' /></a>
	</div>
	<div class="clear"></div>
	<?php echo $form->end();?>
		
	<?php echo $this->element("group/search-table")?>
</div>