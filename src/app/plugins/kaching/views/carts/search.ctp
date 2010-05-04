<?php $columns = 3;?>
<?php $priceFilter = array('0-40' => 'less $40', '40-55' => '$40 - $55', '55-75' => '$55 - $75', '75-100' => '$75 - $100', '100-'=>'more $100'); ?>

<br /><h2><i>Search for:</i>&nbsp;<?php echo h($q)?></h2>

Price Range:
&nbsp;&nbsp;
<a id='price_all' href='/kaching/carts/search/q:<?php echo $q?>'>all</a>
<?php foreach($priceFilter as $key => $filter): ?>
	&nbsp;&nbsp;|&nbsp;&nbsp;
	<a id='price_<?php echo $key?>' href='/kaching/carts/search/q:<?php echo $q?>/limit:10/store:<?php echo $store['Store']['number']?>/pricefilter:<?php echo $key?>'><?php echo $filter?></a>
<?php endforeach; ?>

<hr/>

<?php if (sizeof($products) == 0) { ?>
	<div class="txt-center"><h3>No Products Found matching search criteria</h3></div>
<?php } else { ?>
	<?php echo $this->element("cart/products-box")?>
<?php } ?>