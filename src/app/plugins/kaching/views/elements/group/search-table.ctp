<table id='groupTable' class='simple'>
	<tr><th>Name</th><th>&nbsp;</th></tr>

	<?php foreach($this->data as $group): ?>
		<?php $id = $group['Group']['id'] ?>
		
		<tr>
			<td><?php echo $group['Group']['name']?></td>
			<td class='txt-right'>
				<a href="/kaching/groups/edit/<?php echo $id?>">edit</a>
				
				<?php if ($id != 1) { ?>
					&nbsp;|&nbsp;
					<?php $l = "Do you want to delete Group " . $group['Group']['name'] . "?"; ?>
					<?php echo $ajax->link('delete',array( 'controller' => 'groups', 'action' => 'delete', $id), array( 'update' => 'user','complete' => 'location.reload(true);' ), $l); ?>
				<?php } ?>
			</td>
		</tr>
	<?php endforeach; ?>
		
	<?php if (empty($this->data)) { ?>
		<tr><td colspan='2'>No Groups found.</td></tr>
	<?php } ?>
</table>

<?php echo $this->element('paginator-links'); ?>