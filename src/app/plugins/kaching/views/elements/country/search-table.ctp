<table id='countryTable' class='simple'>
	<tr><th>ID</th><th>Name</th><th>&nbsp;</th></tr>

	<?php if (is_array($this->data)) { ?>
		<?php foreach($this->data as $country): ?>
			<?php $id = $country['Country']['id'] ?>
			<?php $name = $country['Country']['name'] ?>
			
			<tr>
				<td><?php echo $id?></td>
				<td><?php echo $name?></td>
				<td class='txt-right'>
					<a href="/kaching/countries/edit/<?php echo $id?>" title="Edit Country">edit</a>
					
					<?php if (empty($country['Region'])) { ?>
						&nbsp;|&nbsp;
						<?php $l = "Do you want to delete Country " . $name . "?"; ?>
						<?php echo $ajax->link('delete',array( 'controller' => 'countries', 'action' => 'delete', $id), array( 'update' => 'country','complete' => 'location.reload(true);' ), $l); ?>
					<?php } ?>
				</td>
			</tr>
		
		<?php endforeach; ?>
	<?php } ?>	
</table>

<?php echo $this->element('paginator-links'); ?>