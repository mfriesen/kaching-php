<?php $thumbnail = $product['Product']['thumbnail'] ?>
<?php $image = $product['Product']['image']?>
<?php $id = $product['Product']['id']?>

<br />
<a href="/kaching/productsearches/">Back to Search Page</a>
<br /><br />

<?php if (strlen($id) > 0) { ?>
<h4><strong><?php echo $product['Product']['number']?>:&nbsp;<?php echo $product['Product']['title']?></strong></h4>
<?php } ?>

<ul class="tabs"> 
    <li><a <?php if ($tab == '0') { echo "class='current'";} ?> href="/kaching/products/view/<?php echo $id?>">Info</a></li>
    
    <?php if (strlen($id) > 0) { ?>
	    <li><a <?php if ($tab == '1') { echo "class='current'";} ?> href="/kaching/products/category/<?php echo $id?>">Category</a></li>
	    <li><a <?php if ($tab == '2') { echo "class='current'";} ?> href="/kaching/products/retail/<?php echo $id?>">Retail</a></li>
	    <?php if (strlen($thumbnail) > 0 || strlen($image) > 0) { ?>
	    	<li><a <?php if ($tab == '3') { echo "class='current'";} ?> href="/kaching/products/images/<?php echo $id?>">Images</a></li>
	    <?php } ?>
	<?php } ?> 
</ul>