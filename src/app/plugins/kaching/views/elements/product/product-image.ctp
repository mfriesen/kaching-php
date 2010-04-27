<?php $thumbnail = Configure::read('kaching.product-thumbnail.dir') . "/" . $this->data['Product']['thumbnail']; ?>
<?php $image = Configure::read('kaching.product-image.dir') . "/" . $this->data['Product']['image']; ?>

<?php if (!file_exists($thumbnail)) { ?>
<hr />

<?php echo $form->create('Product', array('action'=>'addThumbnailImage', 'class'=>'inline')); ?>

<div class="column span-3 txt-right"><label class='txt-right' for="thumbnail_image">Thumbnail:</label></div>
<div class="column span-21 last">
	<?php echo $form->text("Product.addThumbnail", array("size"=>"75")) ?>
	<?php echo $form->error("Product.addThumbnail") ?>
</div>	
<div class="clear"></div>

<?php echo $form->end(array('label'=>'Add Image', 'div'=>'span-24')); ?>
<div class="clear"></div>

<?php } ?>

<?php if (!file_exists($image)) { ?>
<hr />
<?php echo $form->create('Product', array('action'=>'addImage', 'class'=>'inline')); ?>

<div class="column span-3 txt-right"><label class='txt-right' for="full_image">Image:</label></div>
<div class="column span-21 last">
	<?php echo $form->text("Product.addImage", array("size"=>"75")) ?>
	<?php echo $form->error("Product.addImage") ?>
</div>
<div class="clear"></div>

<?php echo $form->end(array('label'=>'Add Image', 'div'=>'span-24')); ?>
<div class="clear"></div>
<?php } ?>