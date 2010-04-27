<table id='couponTable' class='simple'>
	<tr>
		<th>Title</th>
		<th>Description</th>
		<th class='txt-center' nowrap>Discount (%)</th>
		<th class='txt-center' nowrap>Shipping (%)</th>
		<th class='txt-center' nowrap>Amount ($)</th>
		<th class='txt-center'>Start</th>
		<th class='txt-center'>End</th>
		<th class='txt-center'>Code</th>
		<th>&nbsp;</th>
	</tr>
	

	<?php foreach($this->data as $coupon): ?>
		<?php $id = $coupon['Coupon']['id']; ?>
		<?php $percent = $coupon['Coupon']['percent'] > 0 ? number_format($coupon['Coupon']['percent'],2) : ""; ?>
		<?php $shipping_percent = $coupon['Coupon']['shipping_percent'] > 0 ? number_format($coupon['Coupon']['shipping_percent'],2) : ""; ?>
		<?php $amount = $coupon['Coupon']['amount'] > 0 ? number_format($coupon['Coupon']['amount'], 2) : ""; ?>
		
		<tr>
			<td><?php echo $coupon['Coupon']['title']?></td>
			<td><?php echo $coupon['Coupon']['description']?></td>
			<td class='txt-right'><?php echo $percent?></td>
			<td class='txt-right'><?php echo $shipping_percent?></td>
			<td class='txt-right'><?php echo $amount?></td>
			<td nowrap><?php echo date('M d, Y', $date->stringToDate($coupon['Coupon']['start'])); ?></td>
			<td nowrap><?php echo date('M d, Y', $date->stringToDate($coupon['Coupon']['end'])); ?></td>
			<td><?php echo $coupon['Coupon']['code']?></td>
			<td class='txt-right' nowrap>
				<a href="/kaching/coupons/edit/<?php echo $id?>" title="Edit Coupon">edit</a>
				&nbsp;|&nbsp;
				<?php $l = "Do you want to delete Coupon " . $coupon['Coupon']['title'] . "?"; ?>
				<?php echo $ajax->link('delete',array( 'controller' => 'coupons', 'action' => 'delete', $id), array( 'update' => 'coupon','complete' => 'location.reload(true);' ), $l); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		
	<?php if (empty($this->data)) { ?>
		<tr><td colspan='10'>No Coupons found.</td></tr>
	<?php } ?>
</table>

<?php echo $this->element('paginator-links'); ?>