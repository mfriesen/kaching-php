<table id='shippingTable' class='simple'>
	<tr><th>Weight</th><th>Amount</th><th>&nbsp;</th></tr>

	<?php foreach($this->data['Shippingamount'] as $amount): ?>
		<?php $id = $amount['id']; ?>
		<?php $zone_id = $amount['shippingzone_id']?>
		<?php $weight = $amount['weight'] ?>
		<?php $total = number_format($amount['amount'],2) ?>
		
		<tr>
			<td class='txt-right'><?php echo $weight == 0 ? "ALL" : $amount['weight'] ?></td>
			<td class='txt-right'>$<?php echo $total ?></td>
			<td class='txt-right'>
				<a href="/kaching/shippingamounts/edit/<?php echo $zone_id?>/<?php echo $id?>" title="Edit Shipping Zone">edit</a>
				&nbsp;|&nbsp;
				<?php $l = "Do you want to delete Shipping Amount $" . $total . "?"; ?>
				<?php echo $ajax->link('delete',array( 'controller' => 'shippingamounts', 'action' => 'delete', $id), array( 'update' => 'shippingamount','complete' => 'location.reload(true);' ), $l); ?> 			
				
			</td>
		</tr>
	
	<?php endforeach; ?>	
</table>