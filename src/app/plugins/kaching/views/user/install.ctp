<?php $this->set("title_for_layout", "Kaching Install") ?>

<div class="tab-pane padding10">

	<br /><br /><br /><br />

	<?php echo $form->create('User', array('action'=>'install', 'class'=>'inline')); ?>
	
	<?php echo $this->element("user/install")?>
		
	<?php echo $form->end(array('label'=>"/kaching/img/button-save.png", 'div'=>'span-23 padding10')); ?>
	<div class="clear"></div>
	
</div>

<script type="text/javascript">
document.getElementById('UserUsername').focus();
</script>