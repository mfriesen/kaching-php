<?php list($id, $number, $title, $description, $keywords, $thumbnail, $image, $page) = $cart->product($product) ?>
<?php list($psid, $productid, $storeid, $active, $qty, $vpricing, $tax1, $tax2, $shipping, $retailLevel1, $retailLevel2, $retailLevel3, $discountLevel1, $discountLevel2, $discountLevel3) = $cart->product_store($product) ?>

<?php $title = h($title) ?>
<?php $link = $cart->product_page($product) ?>

<?php $thumbnailpath = $cart->thumbnail_url($product) ?>

<?php list($min, $max) = $cart->retail_range($product)?>

<?php $isLast = ($index % $columns == $columns -1) ?>

<div class="span-6 txt-center product-box <?php if ($isLast) { echo "last"; } ?>" style='<?php if (!$isLast) { echo "margin-right:1px;"; } ?>'>
	
	<h3><strong><a href='<?php echo $link?>'><?php echo $title?></a></strong></h3>

	<div class="product-image">
			<img title='click for details' alt='<?php echo "$title"?>' src='<?php echo $thumbnailpath?>' />
	</div>

	<p>
					
		<?php if ($discountLevel1 > 0) { ?>
				
			<br />Our Price:&nbsp;<strike>$<?php echo $retailLevel1?></strike>
			&nbsp;$<?php echo $discountLevel1?>
				
		<?php } else { ?>
				
			<br />Our Price:&nbsp;$<?php if ($min != $max) { echo "$min - $max"; } else { echo $retailLevel1; }?>
							
		<?php } ?>			
	</p>

	<?php if ($qty > 0) { ?>
		<p>Quantity Remaining:&nbsp;<?php echo $qty?></p>
	<?php } ?>
	<a id='addToCart_<?php echo $id?>' href='/kaching/carts/add/id:<?php echo $id?>'><img src='/kaching/img/cart_add.png' /></a>
</div>