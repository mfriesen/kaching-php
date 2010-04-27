<table id='shippingTable' class='simple'>
	<tr><th>Label</th><th>Description</th><th>&nbsp;</th></tr>

	<?php foreach($this->data as $zone): ?>
		<?php $id = $zone['Shippingzone']['id']; ?>
		
		<tr>
			<td><?php echo $zone['Shippingzone']['label'] ?></td>
			<td><?php echo $zone['Shippingzone']['description'] ?></td>
			<td class='txt-right'>
				<a href="/kaching/shippingzones/edit/<?php echo $id?>" title="Edit Zone">edit</a>
				
				<?php if (empty($zone['Shippingamount'])) { ?>
					&nbsp;|&nbsp;
					<?php $l = "Do you want to delete Shipping Zone " . $zone['Shippingzone']['label'] . "?"; ?>
					<?php echo $ajax->link('delete',array( 'controller' => 'shippingzones', 'action' => 'delete', $id), array( 'update' => 'shippingzone','complete' => 'location.reload(true);' ), $l); ?>
				<?php } ?>
				
			</td>
		</tr>
	
	<?php endforeach; ?>	
</table>

<?php echo $this->element('paginator-links'); ?>