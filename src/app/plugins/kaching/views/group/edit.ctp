<?php $this->pageTitle = "Kaching Group Edit"; ?>

<div class="tab-pane padding10">

<a href="/kaching/groups">Back to Groups</a>
<br /><br />

	<?php echo $form->create('Group', array('action'=>'edit', 'class'=>'inline')); ?>
	<?php echo $this->element("group/edit")?>
		
	<?php echo $form->end(array('label'=>"/kaching/img/button-save.png", 'div'=>'span-23 padding10')); ?>
	<div class="clear"></div>
	
</div>

<script type="text/javascript">
document.getElementById('GroupName').focus();
</script>