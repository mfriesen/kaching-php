<?php
function sort_region($a, $b) {
	$a = $a['region'];
	$b = $b['region'];
	
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}

$aliases = $this->data['Shippingalias'];
uasort($aliases, 'sort_region');
?>

<table id='shippingTable' class='simple'>
	<tr><th>Country</th><th>Region</th><th>City</th><th>Postal / Zip Code</th><th>&nbsp;</th></tr>

	<?php if (is_array($aliases)) { ?>
		<?php foreach($aliases as $alias): ?>
			<?php $id = $alias['id']; ?>
			<?php $zone_id = $alias['shippingzone_id']?>
			<?php $city = $alias['city'] ?>
			<?php $region = $alias['region'] ?>
			<?php $postalcode = $alias['postalcode'] ?>
			<?php $country = $alias['country'] ?>
			<tr>
				<td><?php echo $countries[$country]?></td>
				<td><?php echo $regions[$region]?></td>
				<td><?php echo $city?></td>
				<td><?php echo $postalcode?></td>
				<td class='txt-right'>
					<a href="/kaching/shippingaliases/edit/<?php echo $zone_id?>/<?php echo $id?>" title="Edit Shipping Zone">edit</a>
					&nbsp;|&nbsp;
					<?php $l = "Do you want to delete Shipping Alisa?"; ?>
					<?php echo $ajax->link('delete',array( 'controller' => 'shippingaliases', 'action' => 'delete', $zone_id, $id), array( 'update' => 'shippingalias','complete' => 'location.reload(true);' ), $l); ?>
				</td>
			</tr>
		
		<?php endforeach; ?>
	<?php } ?>	
</table>