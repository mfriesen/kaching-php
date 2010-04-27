<?php $statusMessages = $orderUtil->getOrderStatusMessages();?>
<?php $statusColours = $orderUtil->getOrderStatusColours();?>

<table id='orderTable' class='simple'>
	<tr>
		<th>Order #</th>
		<th>Store</th>
		<th nowrap>Order Date</th>
		<th>Bill To</th>
		<th>Ship To</th>
		<th nowrap>Total</th>
		<th>Status</th>
		<th>&nbsp;</th>
	</tr>

	<?php if (isset($orders)) {
	
		foreach($orders as $order):	
			$status = $order['Order']['status'];
			$statusMessage = $statusColours[$status];
		?>	
			<tr style="color: <?php echo $statusMessage?>">
				<td nowrap><?php echo $order['Order']['id']; ?></td>
				<td nowrap><?php echo $order['Store']['name']; ?></td>			
				<td nowrap><?php echo date('M d, Y g:i A', $date->stringToDate($order['Order']['inserted_date'])); ?></td>
				<td><?php echo $order['Order']['billto_name']; ?></td>
				<td><?php echo $order['Order']['shipto_name']; ?></td>
				<td class='txt-right'>$<?php echo number_format($order['Order']['total'], 2); ?></td>
				<td><?php echo $statusMessages[$order['Order']['status']] ?></td>
				<td class='txt-right'><a href='/kaching/orders/view/<?php echo $order['Order']['id']; ?>'>view</a></td>
			</tr>
		<?php endforeach; ?>
		
		<?php if (empty($orders)) { ?>
			<tr><td colspan='8'>No Orders found.</td></tr>
		<?php } ?>
	<?php } ?>
</table>