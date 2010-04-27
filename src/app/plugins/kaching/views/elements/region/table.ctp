<table id='regionTable' class='simple'>
	<tr><th>Region Name</th><th>&nbsp;</th></tr>

	<?php if (is_array($this->data['Region'])) { ?>
		<?php foreach($this->data['Region'] as $region): ?>
			<?php $id = $region['id'] ?>
			<?php $country_id = $region['country_id']?>
			<?php $name = $region['name'] ?>
			
			<tr>
				<td><?php echo $name?></td>
				<td class='txt-right'>
					<a href="/kaching/regions/edit/<?php echo "$country_id/$id"?>" title="Edit Region">edit</a>
					&nbsp;|&nbsp;
					<?php $l = "Do you want to delete Region " . $name . "?"; ?>
					<?php echo $ajax->link('delete',array( 'controller' => 'regions', 'action' => 'delete', $id), array( 'update' => 'region','complete' => 'location.reload(true);' ), $l); ?>
				</td>
			</tr>
		
		<?php endforeach; ?>
	<?php } ?>	
</table>

<?php echo $this->element('paginator-links'); ?>