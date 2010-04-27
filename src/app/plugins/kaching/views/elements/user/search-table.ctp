<table id='userTable' class='simple'>
	<tr><th>Username</th><th>Group</th><th>Active</th><th>&nbsp;</th></tr>

	<?php foreach($this->data as $user): ?>
		<?php $id = $user['User']['id'] ?>
		<?php $active = $user['User']['active'] ?>
		<?php $group_id = $user['User']['group_id'] ?>
		
		<tr>
			<td><?php echo $user['User']['username']?></td>
			<td>
				<?php if (array_key_exists($group_id, $groups)) { echo $groups[$group_id]; } else { echo $group_id; } ?>
			</td>
			<td><?php echo $active == "1" ? "Yes" : "No";?></td>
			<td class='txt-right'>
				<a href="/kaching/users/edit/<?php echo $id?>">edit</a>&nbsp;|&nbsp;
				<?php $l = "Do you want to delete User " . $user['User']['username'] . "?"; ?>
				<?php echo $ajax->link('delete',array( 'controller' => 'users', 'action' => 'delete', $id), array( 'update' => 'user','complete' => 'location.reload(true);' ), $l); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		
	<?php if (empty($this->data)) { ?>
		<tr><td colspan='4'>No Users found.</td></tr>
	<?php } ?>
</table>

<?php echo $this->element('paginator-links'); ?>