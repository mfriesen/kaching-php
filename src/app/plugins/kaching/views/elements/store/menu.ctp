<?php $id = isset($store['Store']['id']) ? $store['Store']['id'] : "" ?>

<br />
<a href="/kaching/stores">Back to Stores Listing</a>
<br /><br />

<?php if (strlen($id) > 0) { ?>
<h4><strong><?php echo $store['Store']['name']?>&nbsp;(Number:&nbsp;<?php echo $store['Store']['number']?>)</strong></h4>
<?php } ?>

<ul class="tabs"> 
    <li><a <?php if ($tab == '0') { echo "class='current'";} ?> href="/kaching/stores/edit/<?php echo $id?>">Info</a></li>
    
    <?php if (strlen($id) > 0) { ?>
	    <li><a <?php if ($tab == '1') { echo "class='current'";} ?> href="/kaching/stores/shipping/<?php echo $id?>">Shipping Zones</a></li>
	<?php } ?>
	
    <?php if (strlen($id) > 0) { ?>
	    <li><a <?php if ($tab == '2') { echo "class='current'";} ?> href="/kaching/stores/holidays/<?php echo $id?>">Holidays</a></li>
	<?php } ?> 
	 
</ul>