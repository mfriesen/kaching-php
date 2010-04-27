<table id='storeTable' class='simple'>
	<tr><th>Number</th><th>Name</th><th>Website</th><th>Email</th><th>&nbsp;</th></tr>

	<?php foreach($stores as $store): ?>
	<?php $id = $store['Store']['id']; ?>
	<tr>
		<td class='txt-right'><?php echo $store['Store']['number'] ?></td>
		<td><?php echo h($store['Store']['name'])?></td>
		<td class='txt-center'><?php echo $store['Store']['website']?></td>
		<td class='txt-center'><?php echo $store['Store']['email']?></td>
		<td class='txt-right'>
			<a href="/kaching/stores/edit/<?php echo $id?>" title="Edit Store">edit</a>
			&nbsp;|&nbsp;
			<?php $l = "Do you want to delete Store " . $store['Store']['name'] . " (" . $store['Store']['number'] . ") ?"; ?>
			<?php echo $ajax->link('delete',array( 'controller' => 'stores', 'action' => 'delete', $id), array( 'update' => 'store','complete' => 'location.reload(true);' ), $l); ?> 			
		</td>
	</tr>
	
	<?php endforeach; ?>	
</table>

<?php echo $this->element('paginator-links'); ?>