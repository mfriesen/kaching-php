<?php $id = $this->data['Product']['id']; ?>

<?php 
function storeNameSort($a, $b) {
    return strcasecmp($a['Store']['name'], $b['Store']['name']);
}
 
function showRetail($retail, $discount) {
		
	if ($discount > 0) {
		echo "<strike>"; 
	} 
	echo "$$retail";
		
	if ($discount > 0) {
		echo "</strike>&nbsp;$$discount";
	}	
}
?>
<a id="addretaillink" href="/kaching/products/editretail/<?php echo $id ?>" title="Add Retail">
	<img src='/kaching/img/button-new.png' alt="Add Retail" />
</a>
<br />

<?php usort($this->data['ProductStore'], "storeNameSort"); ?>

<?php foreach($this->data['ProductStore'] as $index => $ps): ?>
	
	<?php list($psid, $productid, $storeid, $active, $qty, $vpricing, $tax1, $tax2, $shipping, $retailLevel1, $retailLevel2, $retailLevel3, $discountLevel1, $discountLevel2, $discountLevel3) = $cart->getProductStore($ps); ?>
			
	<table id='productretail' class="simple" summary="product retail">
		<caption><strong><?php echo $ps['Store']['name'] ?></strong></caption>
		<tr>
			<th>Retail Level 1</th>
			
			<?php if ($retailLevel2 > 0) { ?>
			<th>Retail Level 2</th>
			<?php } ?>
			
			<?php if ($retailLevel3 > 0) { ?>
			<th>Retail Level 3</th>
			<?php } ?>
			
			<th>Qty</th>
			<th>Shipping</th>
			
			<?php if (strlen($ps['Store']['tax1name']) > 0) {?>
				<th><?php echo $ps['Store']['tax1name']?></th>
			<?php } ?>
			
			<?php if (strlen($ps['Store']['tax2name']) > 0) {?>
				<th><?php echo $ps['Store']['tax2name']?></th>
			<?php } ?>
			
			<th>Active</th>
			<th class='txt-right'>Actions</th>
		</tr>
	
		<tr>
			<td class='txt-right' nowrap><?php showRetail($retailLevel1, $discountLevel1) ?></td>
			
			<?php if ($retailLevel2 > 0) { ?>
			<td class='txt-right' nowrap><?php showRetail($retailLevel2, $discountLevel2) ?></td>
			<?php } ?>
			
			<?php if ($retailLevel3 > 0) { ?>
			<td class='txt-right' nowrap="nowrap"><?php showRetail($retailLevel3, $discountLevel3) ?></td>
			<?php } ?>
			
			<td class='txt-center'><?php echo $qty == -1 ? "Unlimited" : $qty; ?></td>
			<td class='txt-center'><?php echo $shipping == '1' ? 'YES' : 'NO'; ?></td>
			
			<?php if (strlen($ps['Store']['tax1name']) > 0) {?>
				<td class='txt-center'><?php echo $tax1 == '1' ? 'YES' : 'NO'; ?></td>
			<?php } ?>
			
			<?php if (strlen($ps['Store']['tax2name']) > 0) {?>
				<td class='txt-center'><?php echo $tax2 == '1' ? 'YES' : 'NO'; ?></td>
			<?php } ?>
			
			<td class='txt-center'><?php echo $active == '1' ? 'YES' : 'NO'; ?></td>
			<td class='txt-right' nowrap>
				<?php if ($active == true) { ?>
					<?php $l = "Do you want to Disable " . $ps['Store']['name'] . "?"; ?>
					<?php echo $ajax->link('disable',array( 'controller' => 'products', 'action' => 'disable', $id, $psid), array( 'id'=>"disable_$index", 'update' => 'product','complete' => 'location.reload(true);' ), $l); ?>
				<?php } ?>
				<?php if ($active == false) { ?>
					<?php $l = "Do you want to Enable " . $ps['Store']['name'] . "?"; ?>
					<?php echo $ajax->link('enable',array( 'controller' => 'products', 'action' => 'enable', $id, $psid), array( 'id'=>"enable_$index", 'update' => 'product','complete' => 'location.reload(true);' ), $l); ?>
				<?php } ?>
				&nbsp;|&nbsp;				
				<a id="edit_<?php echo $index?>" href="/kaching/products/editretail/<?php echo $id ?>/<?php echo $psid ?>" title="Edit Retail">edit</a>
				&nbsp;|&nbsp;
				<?php $l = "Do you want to delete Retail for " . $ps['Store']['name'] . "?"; ?>
				<?php echo $ajax->link('delete',array( 'controller' => 'products', 'action' => 'deleteRetail', $id, $psid), array( 'id'=>"delete_retail_$index", 'update' => 'product','complete' => 'location.reload(true);' ), $l); ?> 			
			</td>
		</tr>
	</table>
<?php endforeach; ?>
