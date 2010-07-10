<?php $this->set("title_for_layout", "Kaching User Edit") ?>

<div class="tab-pane padding10">

<a href="/kaching/users/search">Back to Users</a>
<br /><br />

	<?php echo $form->create('User', array('action'=>'edit', 'class'=>'inline')); ?>
	<?php echo $this->element("user/edit")?>
		
	<?php echo $form->end(array('label'=>"/kaching/img/button-save.png", 'div'=>'span-23 padding10')); ?>
	<div class="clear"></div>
	
</div>

<script type="text/javascript">
document.getElementById('UserUsername').focus();
</script>