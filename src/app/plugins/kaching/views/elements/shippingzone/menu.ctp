<?php $id = isset($zone['Shippingzone']['id']) ? $zone['Shippingzone']['id'] : "" ?>

<br />
<a href="/kaching/shippingzones">Back to Shipping Zones</a>
<br /><br />

<?php if (strlen($id) > 0) { ?>
<h4>Shipping Zone:&nbsp;<strong><?php echo $zone['Shippingzone']['label']?></strong></h4>
<?php } ?>

<ul class="tabs"> 
    <li><a <?php if ($tab == '0') { echo "class='current'";} ?> href="/kaching/shippingzones/edit/<?php echo $id?>">Info</a></li>
    
    <?php if (strlen($id) > 0) { ?>
	    <li><a <?php if ($tab == '1') { echo "class='current'";} ?> href="/kaching/shippingamounts/index/<?php echo $id?>">Amount</a></li>	    
   	    <li><a <?php if ($tab == '2') { echo "class='current'";} ?> href="/kaching/shippingaliases/index/<?php echo $id?>">Alias</a></li>
	<?php } ?> 
</ul>