<table id='statsTable' class='simple'>
	<tr>
		<th>Store</th>
		<th nowrap>Number</th>
		<th>Title</th>
		<th>Count</th>
		<th>&nbsp;</th>
	</tr>
	
	<?php if (isset($list)) { ?>
		<?php foreach($list as $item): ?>
			<?php $store = $stores[$item['Order']['store_id']] ?>
			<?php $product = $products[$item['OrderDetail']['product_id']] ?>
			
			<tr>
				<td><?php echo $store['Store']['name'] ?></td>
				<td><?php echo $store['Store']['number'] ?></td>			
				<td><?php echo $product['Product']['title']?></td>
				<td><?php echo $item[0]['count'] ?></td>
				<td class='txt-right'><a href='/kaching/products/view/<?php echo $product['Product']['id']; ?>'>view</a></td>
			</tr>
		<?php endforeach; ?>
	<?php } ?>
		
	<?php if (!isset($list) || empty($list)) { ?>
		<tr><td colspan='4'>No orders found in time period.</td></tr>
	<?php } ?>
</table>