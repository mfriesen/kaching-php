<?php $id = isset($country['Country']['id']) ? $country['Country']['id'] : "" ?>

<br />
<a href="/kaching/countries">Back to Countries</a>
<br /><br />

<?php if (strlen($id) > 0) { ?>
<h4>Country:&nbsp;<strong><?php echo $country['Country']['name']?></strong></h4>
<?php } ?>

<ul class="tabs"> 
    <li><a <?php if ($tab == '0') { echo "class='current'";} ?> href="/kaching/countries/edit/<?php echo $id?>">Info</a></li>
    
    <?php if (strlen($id) > 0) { ?>
	    <li><a <?php if ($tab == '1') { echo "class='current'";} ?> href="/kaching/regions/index/<?php echo $id?>">Regions</a></li>
	<?php } ?> 
</ul>