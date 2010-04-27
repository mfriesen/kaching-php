<table id='userTable' class='simple'>
	<tr><th>Email</th><th>&nbsp;</th></tr>

	<?php foreach($this->data as $user): ?>
		<?php $id = $user['Mailinglist']['id']; ?>
		<tr>
			<td><?php echo $user['Mailinglist']['email']?></td>
			<td class='txt-right'>
				<?php $l = "Do you want to delete Email " . $user['Mailinglist']['email'] . "?"; ?>
				<?php echo $ajax->link('delete',array( 'controller' => 'mailinglists', 'action' => 'delete', $id), array( 'update' => 'mailinglist','complete' => 'location.reload(true);' ), $l); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		
	<?php if (empty($this->data)) { ?>
		<tr><td colspan='2'>No Email Addresses found.</td></tr>
	<?php } ?>
</table>

<?php echo $this->element('paginator-links'); ?>