<div class="tab-pane padding10">

<a href="/kaching/categories">Back to Categories Page</a>
<br /><br />

	<?php echo $form->create('Category', array('action'=>'edit', 'class'=>'inline')); ?>
	<?php echo $this->element("category/edit")?>
		
	<?php echo $form->end(array('label'=>"/kaching/img/button-save.png", 'div'=>'span-23 padding10')); ?>
	<div class="clear"></div>
	
</div>