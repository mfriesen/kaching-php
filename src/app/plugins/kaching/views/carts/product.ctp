<?php $imageUrl = Configure::read('kaching.product-image.url'); ?>
<?php $imageDir = Configure::read('kaching.product-image.dir'); ?>

<?php list($id, $number, $title, $description, $keywords, $thumbnail, $image, $page) = $cart->getProduct($product); ?>
<?php list($psid, $productid, $storeid, $active, $qty, $vpricing, $tax1, $tax2, $shipping, $retailLevel1, $retailLevel2, $retailLevel3, $discountLevel1, $discountLevel2, $discountLevel3) = $cart->product_store($product); ?>

<?php $active = $cart->isProductActive($product) ?>

<?php $title = h($title) ?>

<h2 class='txt-center margin0'>Product: <?php echo $number?><br /><?php echo $title?></h2>

<hr />

<div class="span-11 txt-center">
	<?php if (is_file($imageDir . "/$image")) { ?>
		<img alt='<?php echo $number?> <?php echo $title?>' border='0' src='<?php echo $imageUrl?>/<?php echo $image?>' />
	<?php } else { ?>
		<img alt='<?php echo $number?> <?php echo $title?>' border='0' src='/kaching/img/no-image.jpg' />
	<?php } ?>

	<div class="clear">&nbsp;</div>	
	<?php echo $description?>
</div>

<div class="span-6 last">

	<?php echo $form->create('Cart', array('action'=>'add')); ?>
	
		<input type='hidden' name='data[Store][number]' value="<?php echo $store['Store']['number']?>" />
		<input type='hidden' name='data[OrderDetail][0][product_id]' value="<?php echo $id?>" />
		<input type='hidden' name='data[OrderDetail][0][qty]' value="1" />		

		<h3>Pricing Options:</h3>
			
		<?php if ($retailLevel1 > 0) { ?>			
			<?php if ($discountLevel1 > 0) { ?>
				<input id='retail1' type='radio' name='data[OrderDetail][0][retail]' value="<?php echo $discountLevel1?>" checked />
				<span style='font-size:1.2em;'><strike>$<?php echo $retailLevel1?></strike>&nbsp;$<?php echo $discountLevel1?></span><br/>
			<?php } else {?>
				<input id='retail1' type='radio' name='data[OrderDetail][0][retail]' value="<?php echo $retailLevel1?>" checked />
				<span style='font-size:1.2em;'>$<?php echo $retailLevel1?></span><br/>
			<?php } ?>
		<?php } ?>

		<?php if ($retailLevel2 > 0) { ?>			
			<?php if ($discountLevel2 > 0) { ?>
				<input id='retail2' type='radio' name='data[OrderDetail][0][retail]' value="<?php echo $discountLevel2?>" />
				<span style='font-size:1.2em;'><strike>$<?php echo $retailLevel2?></strike>&nbsp;$<?php echo $discountLevel2?></span><br/>
			<?php } else {?>
				<input id='retail' type='radio' name='data[OrderDetail][0][retail]' value="<?php echo $retailLevel2?>" />
				<span style='font-size:1.2em;'>$<?php echo $retailLevel2?></span><br/>
			<?php } ?>
		<?php } ?>

		<?php if ($retailLevel3 > 0) { ?>			
			<?php if ($discountLevel3 > 0) { ?>
				<input id='retail' type='radio' name='data[OrderDetail][0][retail]' value="<?php echo $discountLevel3?>" />
				<span style='font-size:1.2em;'><strike>$<?php echo $retailLevel3?></strike>&nbsp;$<?php echo $discountLevel3?></span><br/>
			<?php } else {?>
				<input id='retail' type='radio' name='data[OrderDetail][0][retail]' value="<?php echo $retailLevel3?>" />
				<span style='font-size:1.2em;'>$<?php echo $retailLevel3?></span><br/>
			<?php } ?>
		<?php } ?>
					
		<?php if ($qty > 0) { ?>
		Quantity Remaining:&nbsp;<?php echo $qty?><br/>
		<?php } ?>
	<br />	
	<?php if ($active == 1 && $qty != 0) { ?>
		<?php echo $form->end(array('name'=>"addToCart_$id", 'label'=>"/kaching/img/button-add.png")); ?>
	<?php } else { echo $form->end(); }	?>
	
</div>