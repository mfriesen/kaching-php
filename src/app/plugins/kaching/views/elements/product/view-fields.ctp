<?php $id = isset($this->data['Product']['id']) ? $this->data['Product']['id'] : ""; ?>

<?php if (isset($this->data['Product']['inserted_date'])) { ?>

	<?php $insertedDate = $this->data['Product']['inserted_date']; ?>
	
	<?php $insertedDate = $date->formatDate($insertedDate, "F d, Y (l)"); ?>	
	
	<div class="span-3 txt-right"><label class='txt-right' for="inserteddate">Inserted Date:</label></div>	
	<div class="span-9"><?php echo $insertedDate?></div>
	
	<?php $modifiedDate = $this->data['Product']['modified_date']; ?>
	<?php $modifiedDate = $date->formatDate($modifiedDate, "F d, Y (l)"); ?>	
	<div class="span-3 txt-right"><label class='txt-right' for="modifieddate">Modified Date:</label></div>
	<div class="span-9 span-9-border-1 last"><?php echo $modifiedDate?></div>
	
<?php } ?>

<div class="span-3 txt-right"><label class='txt-right' for="number">Number:</label></div>
<div class="span-9">
	<?php echo $form->text("Product.number", array("size"=>"35", "maxlength"=>"64")) ?>
	<a class="tooltip" title="Product's number, must be unique"><img width='20' height='20' src='/kaching/img/info.png' alt='product number'/></a>
	<?php echo $form->error("Product.number") ?>
</div>

<div class="span-3 txt-right"><label class='txt-right' for="title">Title:</label></div>
<div class="span-9 span-9-border-1 last">
	<?php echo $form->text("Product.title", array("size"=>"40", "maxlength"=>"64")) ?>
	<?php echo $form->error("Product.title") ?>
</div>
<div class='clear'></div>

<div class="span-3 txt-right"><label class='txt-right' for="description">Description:</label></div>
<div class="span-9">
	<?php echo $form->textarea("Product.description", array('cols'=>"45", 'rows'=>"6")) ?>
	<?php echo $form->error("Product.description") ?>
</div>

<div class="span-3 txt-right"><label class='txt-right' for="keywords">Keywords:</label></div>
<div class="span-9 span-9-border-1 last">
	<?php echo $form->textarea("Product.keywords", array('cols'=>"45", 'rows'=>"6")) ?>
	<?php echo $form->error("Product.keywords") ?>
</div>

<div class="span-3 txt-right"><label class='txt-right' for="page">Weight:</label></div>
<div class="span-9">
	<?php echo $form->text("Product.weight", array("size"=>"5", "maxlength"=>"10")) ?>
	<a class="tooltip" title="Set to 0 to ignore weight"><img width='20' height='20' src='/kaching/img/info.png' alt='product weight'/></a>
	<?php echo $form->error("Product.weight") ?>
</div>

<div class="span-3 txt-right"><label class='txt-right' for="page">Page:</label></div>
<div class="span-9 span-9-border-1 last">
	<?php echo $form->text("Product.page", array("size"=>"37", "maxlength"=>"64")) ?>
	<a class="tooltip" title="Url friendly name for Product.">
		<img width='20' height='20' src='/kaching/img/info.png' alt='product page'/>
	</a>	
	<?php echo $form->error("Product.page") ?>
</div>
<div class='clear'></div>

<?php $isThumbnailSet = isset($this->data['Product']['thumbnail']) && strlen($this->data['Product']['thumbnail']) > 0 && $id != ""; ?>

<div class="span-3 txt-right"><label class='txt-right' for="thumbnail">Thumbnail Name:</label></div>
<div class="span-9 span-9-border-1">
	
	<?php if ($isThumbnailSet) { ?>
		<?php echo $this->data['Product']['thumbnail']?>
	<?php } else { ?>
		<?php echo $form->text("Product.thumbnail", array("size"=>"32", "maxlength"=>"64")) ?>
		<?php echo $form->error("Product.thumbnail") ?>
	<?php } ?>

	<?php if (isset($this->data['Product']['thumbnail'])) { ?>
		<?php $thumbnail = Configure::read('kaching.product-thumbnail.dir') . "/" . $this->data['Product']['thumbnail']; ?>
		<?php $thumbnailUrl = Configure::read('kaching.product-thumbnail.url') . "/" . $this->data['Product']['thumbnail']; ?>
	
		<?php if (is_file($thumbnail)) { ?>
			<a href="<?php echo $thumbnailUrl?>" class="preview"><img src="/kaching/img/file.png" alt="thumbnail image" /></a>
		<?php } ?>
	<?php } ?>
</div>

<?php $isImageSet = isset($this->data['Product']['image']) && strlen($this->data['Product']['image']) > 0 && $id != ""; ?>
<div class="span-3 txt-right"><label class='txt-right' for="image">Image Name:</label></div>
<div class="span-9 span-9-border-1 last">

	<?php if ($isImageSet) { ?>
		<?php echo $this->data['Product']['image']?>
	<?php } else { ?>
		<?php echo $form->text("Product.image", array("size"=>"32", "maxlength"=>"64")) ?>
		<?php echo $form->error("Product.image") ?>
	<?php } ?>
	
	<?php if (isset($this->data['Product']['image'])) { ?>
		<?php $image = Configure::read('kaching.product-image.dir') . "/" . $this->data['Product']['image']; ?>
		<?php $imageUrl = Configure::read('kaching.product-image.url') . "/" . $this->data['Product']['image']; ?>
	
		<?php if (is_file($image)) { ?>
			<a href="<?php echo $imageUrl?>" class="preview"><img src="/kaching/img/file.png" alt="image" /></a>
		<?php } ?>
	<?php } ?>
</div>
<div class="clear"></div>

<script type="text/javascript">
document.getElementById('ProductNumber').focus();
</script>