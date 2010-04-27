<div class="span-11">
	<?php echo $form->error('Productsearch.q') ?>
	<?php echo $form->input('Productsearch.q', 
			array('label' => __('Query:&nbsp;', true), 'type' => 'text', 'size' => '45', 'maxlength'=>'45', 'id'=>'q'));
	?>
</div>