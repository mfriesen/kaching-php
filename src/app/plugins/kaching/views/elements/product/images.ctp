<?php $thumbnail = $this->data['Product']['thumbnail'] ?>
<?php $image = $this->data['Product']['image']?>

<?php if (strlen($thumbnail) > 0) { ?>
	<?php echo $form->create('Product', array('action'=>'addthumbnail', 'class'=>'inline', 'enctype'=>"multipart/form-data")); ?>
	<?php echo $form->hidden('id');?>
	
	<div class="column span-3 txt-right"><label class='txt-right' for="thumbnail">Thumbnail:</label></div>	
	<div class="column span-9 last">
		<?php echo $form->file("Product.thumbnail", array("size"=>"60"))?>
	</div>
	
	<?php echo $form->end(array('label'=>"/kaching/img/button-upload.png", 'div'=>'span-24 last')); ?>
	<div class="clear">&nbsp;</div>
<?php } ?>

<?php if (strlen($image) > 0) { ?>
	<?php echo $form->create('Product', array('action'=>'addimage', 'class'=>'inline', 'enctype'=>"multipart/form-data")); ?>
	<?php echo $form->hidden('id');?>
	
	<div class="column span-3 txt-right"><label class='txt-right' for="image">Image:</label></div>	
	<div class="column span-9 last">
		<?php echo $form->file("Product.image", array("size"=>"60"))?>
	</div>
	
	<?php echo $form->end(array('label'=>"/kaching/img/button-upload.png", 'div'=>'span-24 last')); ?>
	<div class="clear">&nbsp;</div>
<?php } ?>