<?php $thumbnailDir = Configure::read("kaching.product-thumbnail.dir"); ?>
<?php $thumbnailUrl = Configure::read('kaching.product-thumbnail.url'); ?>

<?php list($id, $number, $title, $description, $keywords, $thumbnail, $image, $page) = $cart->getProduct($product); ?>
<?php list($psid, $productid, $storeid, $active, $qty, $vpricing, $tax1, $tax2, $shipping, $retailLevel1, $retailLevel2, $retailLevel3, $discountLevel1, $discountLevel2, $discountLevel3) = $cart->getProductStore($product); ?>

<?php $title = h($title); ?>
<?php $link = strlen($page) > 0 ?	$link = "/product/$page" : "/kaching/carts/product/id:$id"; ?>

<?php $thumbnailpath = is_file("$thumbnailDir/$thumbnail") ? "$thumbnailUrl/$thumbnail" : "/kaching/img/no-image.jpg"?>

<?php 
$a = array($retailLevel1, $retailLevel2, $retailLevel3, $discountLevel1, $discountLevel2, $discountLevel3);

foreach ($a as $index => $v):
	if ($v == 0)
		unset($a[$index]);
endforeach;

$min = min($a);
$max = max($a);
?>
	
<div class='productbox'>

	<h4><strong><a href='<?php echo $link?>'><?php echo $title?></a></strong></h4><br/>
	
	<a id='link_<?php echo $id?>' href='<?php echo $link?>'>
		<span class="block">
			<img title='click for details' alt='<?php echo "$title"?>' border='0' src='<?php echo $thumbnailpath?>' />
		</span>
	</a>
					
	<span class="block">
					
		<?php if ($discountLevel1 > 0) { ?>
				
			<br />Our Price:&nbsp;<strike>$<?php echo $retailLevel1?></strike>
			&nbsp;$<?php echo $discountLevel1?>
				
		<?php } else { ?>
				
			<br />Our Price:&nbsp;$<?php if ($min != $max) { echo "$min - $max"; } else { echo $retailLevel1; }?>
							
		<?php } ?>	
				
		<?php if ($qty > 0) { ?>
			<br/>Quantity Remaining:&nbsp;<?php echo $qty?>
		<?php } else {?>
			<br/>&nbsp;
		<?php } ?>
	</span>
	
	<a id='addToCart_<?php echo $id?>' href='/kaching/carts/add/id:<?php echo $id?>'><img src='/kaching/img/cart_add.png' /></a>
</div>