<?php $thumbnailUrl = Configure::read("kaching.product-thumbnail.url") ?>
<?php $thumbnailDir = Configure::read("kaching.product-thumbnail.dir") ?>

<?php 
function showRetail($label, $retail, $discount) {
	if ($retail > 0) {
		echo "<i>$label:</i>&nbsp;";
		
		if ($discount > 0) {
			echo "<strike>"; 
		} 
		echo "$$retail";
		
		if ($discount > 0) {
			echo "</strike>&nbsp;$$discount";
		}
	}	
}
?>

<table id='productTable' class='simple' >
	<tr>
		<th nowrap>Store</th>
		<th>Number</th>
		<th>Title</th>
		<th>Added</th>
		<th class='txt-center'>Active</th>
		<th class='txt-center'>Retail</th>
		<th class='txt-center'>Image</th>
		<th>&nbsp;</th>
	</tr>
	
	<tbody id='productTableBody' align='center'>

	<?php foreach($this->data as $product): ?>
	
		<?php list($id, $number, $title, $description, $keywords, $thumbnail, $image, $page, $inserted, $modified) = $cart->getProduct($product); ?>
		<?php $thumbUrl = is_file("$thumbnailDir/$thumbnail") ? "$thumbnailUrl/$thumbnail" : "/kaching/img/no-image.jpg"; ?>
		
		<?php foreach($product['ProductStore'] as $productStore): ?>

			<?php list($psid, $productid, $storeid, $active, $qty, $vpricing, $tax1, $tax2, $shipping, $retailLevel1, $retailLevel2, $retailLevel3, $discountLevel1, $discountLevel2, $discountLevel3) = $cart->getProductStore($productStore); ?>
		
			<tr>
				<td><?php echo $stores[$storeid]?></td>
				<td nowrap><?php echo $number ?></td>
				<td><?php echo h($title) ?></td>
				<td nowrap><?php echo date('M d, Y g:i A', $date->stringToDate($inserted)) ?></td>
				<td class='txt-center' nowrap><?php echo $active == "1" ? "Active" : "Inactive";?></td>
				<td nowrap>
					<?php echo showRetail("Retail Level 1", $retailLevel1, $discountLevel1)?>
					<?php echo showRetail("<br />Retail Level 2", $retailLevel2, $discountLevel2)?>
					<?php echo showRetail("<br />Retail Level 3", $retailLevel3, $discountLevel3)?>
				</td>
				<td class='txt-center'><img alt='<?php echo $number ?> image' src='<?php echo $thumbUrl ?>' /></td>
				<td class='txt-right'>&nbsp;<a href='/kaching/products/view/<?php echo $product['Product']['id']; ?>'>edit</a>&nbsp;</td>
			</tr>
			
		<?php endforeach; ?>

		<?php if (empty($product['ProductStore'])) { ?>
			<tr>
				<td>&nbsp;</td>
				<td nowrap><?php echo $number ?></td>
				<td><?php echo h($title) ?></td>
				<td nowrap><?php echo date('M d, Y g:i A', $date->stringToDate($inserted)) ?></td>
				<td class='txt-center' nowrap>Inactive</td>
				<td>&nbsp;</td>
				<td class='txt-center'><img alt='<?php echo $number ?> image' src='<?php echo $thumbUrl ?>' /></td>
				<td class='txt-right'>&nbsp;<a href='/kaching/products/view/<?php echo $product['Product']['id']; ?>'>edit</a>&nbsp;</td>
			</tr>
		<?php } ?>
		
	<?php endforeach; ?>
	
	<?php if (empty($this->data)) { ?>
		<tr><td colspan='8'>No Products found.</td></tr>
	<?php } ?>		
	
	</tbody>
</table>
<br />
<?php echo $this->element('paginator-links'); ?>
